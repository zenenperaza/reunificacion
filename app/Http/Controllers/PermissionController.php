<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Lista de permisos protegidos
    protected $permisosProtegidos = [
           'Dashboard',

            'Gestion casos',
            'crear casos',
            'ver casos',
            'editar casos',
            'eliminar casos',
            'aprobar casos',            
            'clonar casos',
            'cierre atencion',
            'ver informes',
            'ver casos eliminados',
            'restaurar casos eliminados',
            'guardar continuar',

            'ver bitacora',

            'Gestion permisos',

            'Gestion roles',
            'ver roles',
            'editar roles',
            'crear roles',
            'eliminar roles',

            'Gestion usuarios',
            'ver usuarios',
            'editar usuarios',
            'crear usuarios',
            'eliminar usuarios',

            'Gestion configuracion',
            'backups',
            'configuracion',
            'sistema deshabilitado',
            'cambiar fecha actual',

            'ver familias',
            'crear familias',
            'editar familias',
            'eliminar familias',
            
            'dashboard-user',
    ];

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

        // Prevenir duplicación de un permiso protegido
        if (in_array($request->name, $this->permisosProtegidos)) {
            return redirect()->route('permission.index')->with('error', '❌ No puedes crear un permiso protegido.');
        }

        Permission::create(['name' => $request->name]);

        return redirect()->route('permission.index')->with('success', '✅ Permiso creado correctamente.');
    }

    public function update(Request $request, Permission $permission)
    {
        // Proteger si el permiso original o el nuevo nombre están en la lista protegida
        if (in_array($permission->name, $this->permisosProtegidos) || in_array($request->name, $this->permisosProtegidos)) {
            return redirect()->route('permission.index')->with('error', '❌ No puedes modificar un permiso protegido.');
        }

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permission.index')->with('success', '✅ Permiso actualizado correctamente.');
    }

    public function destroy(Permission $permission)
    {
        if (in_array($permission->name, $this->permisosProtegidos)) {
            return redirect()->route('permission.index')->with('error', '❌ No puedes eliminar un permiso protegido.');
        }

        $permission->delete();

        return redirect()->route('permission.index')->with('success', '✅ Permiso eliminado correctamente.');
    }
}
