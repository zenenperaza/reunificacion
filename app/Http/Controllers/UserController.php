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

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

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

        return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuario eliminado correctamente.');
    }

    


    public function data()
    {
        
        return DataTables::of(User::with('role')->select('users.*'))
            ->addColumn('acciones', function ($user) {
                $edit = route('users.edit', $user->id);
                $delete = route('users.destroy', $user->id);
                return '
                    <a href="'.$edit.'" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></a>
                    <form method="POST" action="'.$delete.'" style="display:inline-block" onsubmit="return confirm(\'¿Eliminar este usuario?\')">
                        '.csrf_field().method_field('DELETE').'
                        <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></button>
                    </form>';
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

}
