<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('role.index')->with('success', 'Rol creado correctamente.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('role.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->name, ['Administrador'])) {
            return redirect()->route('role.index')->with('error', 'No puedes eliminar este rol.');
        }

        $role->delete();
        return redirect()->route('role.index')->with('success', 'Rol eliminado correctamente.');
    }
}
