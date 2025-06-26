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
        return view('user.index');
    }



    public function create()
    {
        $roles = Role::all(); // roles con nombre (Spatie)
        return view('user.create', compact('roles'));
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
        ]);

        $data = $request->except('role'); // excluye 'role' del insert directo
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        // Crear el usuario
        $user = User::create($data);

        // Asignar rol
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }





    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'phone' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|image|max:2048',
            'role' => 'required|exists:roles,name',
        ]);

        $data = $request->except('role'); // excluye el campo role del update directo

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

        $user->update($data);

        // Actualizar rol con Spatie
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }


public function data()
{
    return DataTables::of(User::with('roles')->select('users.*'))
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
        ->addColumn('acciones', function ($user) {
            return '
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#deleteModal" data-user-id="'.$user->id.'"
                    data-user-name="'.$user->name.'">
                    <i class="mdi mdi-delete"></i>
                </button>
                <a href="'.route('users.edit', $user->id).'" class="btn btn-sm btn-primary">
                    <i class="mdi mdi-pencil"></i>
                </a>';
        })
        ->rawColumns(['acciones', 'photo', 'roles'])
        ->make(true);
}

}
