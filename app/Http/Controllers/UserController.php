<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{


    public function index()
    {
        $usuarios = User::with('roles', 'parent')->paginate(15); // puedes ajustar el número

        return view('user.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();

        // Solo usuarios que no son hijos, es decir, que pueden ser asignados como superiores
        $usuarios_superiores = User::whereNull('parent_id')->get();

        return view('user.create', compact('roles', 'usuarios_superiores'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|image|max:2048',
            'role' => 'required|exists:roles,name',
            'parent_id' => 'nullable|exists:users,id',
        ]);

        // Validar que el usuario seleccionado como padre no sea hijo
        if ($request->filled('parent_id')) {
            $padre = User::find($request->parent_id);
            if ($padre && $padre->parent_id !== null) {
                return redirect()->back()
                    ->withErrors(['parent_id' => '❌ No puedes asignar como superior a un usuario que ya es hijo.'])
                    ->withInput();
            }
        }

        $data = $request->except('role'); // Excluye 'role' del insert directo
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        $data['parent_id'] = $request->input('parent_id');

        // Valor del checkbox "es_superior"
        $data['es_superior'] = $request->has('es_superior');

        // Crear el usuario
        $user = User::create($data);

        // Asignar rol
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }



    public function edit(User $user)
    {
        $roles = Role::all();

        // Solo usuarios que no son hijos y que no sean el mismo usuario
        $usuarios_superiores = User::whereNull('parent_id')
            ->where('id', '!=', $user->id)
            ->get();

        return view('user.edit', compact('user', 'roles', 'usuarios_superiores'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|image|max:2048',
            'role' => 'required|exists:roles,name',
            'parent_id' => 'nullable|exists:users,id',
        ]);

        // Validaciones de jerarquía
        if ($request->filled('parent_id')) {
            if ($request->parent_id == $user->id) {
                return redirect()->back()
                    ->withErrors(['parent_id' => '❌ Un usuario no puede ser su propio superior.'])
                    ->withInput();
            }

            $padre = User::find($request->parent_id);
            if ($padre && $padre->parent_id !== null) {
                return redirect()->back()
                    ->withErrors(['parent_id' => '❌ No puedes asignar como superior a un usuario que ya es hijo.'])
                    ->withInput();
            }
        }

        $data = $request->except('role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        $data['parent_id'] = $request->input('parent_id');

        // Valor del checkbox "es_superior"
        $data['es_superior'] = $request->has('es_superior');

        $user->update($data);

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if ($user->casos()->count() > 0) {
            return redirect()->route('users.index')
                ->with('error', '❌ No puedes eliminar este usuario porque tiene casos asociados. Lo que si puedes hacer es Desactivarlo');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', '✅ Usuario eliminado correctamente.');
    }




    public function data()
    {
        return DataTables::of(User::with(['roles', 'parent'])->select('users.*'))
            ->addColumn('roles', function ($user) {
                return $user->roles->pluck('name')->implode(', ');
            })
            ->addColumn('photo', function ($user) {
                if ($user->photo) {
                    $url = asset('storage/' . $user->photo);
                    return '<img src="' . $url . '" alt="Foto" class="img-thumbnail" width="50">';
                }
                return '<span class="text-muted">Sin foto</span>';
            })
            ->addColumn('superior', function ($user) {
                return $user->parent?->name ?? '<span class="text-muted">Ninguno</span>';
            })
            ->addColumn('estatus', function ($user) {
                $checked = $user->estatus === 'activo' ? 'checked' : '';
                $label = $user->estatus === 'activo' ? 'Activo' : 'Inactivo';
                return '<input type="checkbox" class="switch-status" data-id="' . $user->id . '" ' . $checked . ' /> <span class="estatus-label">' . $label . '</span>';
            })
            ->addColumn('acciones', function ($user) {
                return '
                <a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-primary me-1">
                    <i class="mdi mdi-pencil"></i>
                </a>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#deleteModal" data-user-id="' . $user->id . '"
                    data-user-name="' . $user->name . '">
                    <i class="mdi mdi-delete"></i>
                </button>';
            })
            ->rawColumns(['acciones', 'photo', 'roles', 'estatus', 'superior'])
            ->make(true);
    }


    public function cambiarEstatus(Request $request, User $user)
    {
        $user->estatus = $request->estatus;
        $user->save();
        return response()->json(['success' => true]);
    }
}
