<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('role.permisos', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permission.index')->with('success', 'Permiso creado correctamente.');
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permission.index')->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permission.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
