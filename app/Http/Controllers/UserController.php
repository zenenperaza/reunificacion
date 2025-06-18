<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
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
        'role_id' => 'required|exists:roles,id',
    ]);

    // Carga todos los datos
    $data = $request->all();
    $data['password'] = Hash::make($request->password);

    // Maneja la foto después de cargar $data
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('users', 'public');
    }

    User::create($data);

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
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) Storage::disk('public')->delete($user->photo);
            $data['photo'] = $request->file('photo')->store('users', 'public');
        }

        $user->update($data);

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
    return DataTables::of(User::with('role')->select('users.*'))
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
        ->rawColumns(['acciones', 'photo'])
        ->make(true);
}




}
