<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Usar exactamente los nombres como están en el menú
        $permisos = [
            'Dashboard',
            'dashboard-user',
            
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
            'cambiar fecha actual',
            'guardar continuar',

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

            'Gestion permisos',
            'Gestion configuracion',
            'ver bitacora',
            'backups',
            'configuracion',
            'sistema deshabilitado',

            'ver familias',
            'crear familias',
            'editar familias',
            'eliminar familias',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $coordinador = Role::firstOrCreate(['name' => 'Coordinador']);        
        $puntofocal = Role::firstOrCreate(['name' => 'Punto focal']);       
        $monitor = Role::firstOrCreate(['name' => 'Monitor']);
        $usuario = Role::firstOrCreate(['name' => 'Usuario']);

        $admin->syncPermissions(Permission::all());
        $coordinador->syncPermissions(Permission::all());
        $puntofocal->syncPermissions(Permission::all());
        $monitor->syncPermissions(Permission::all());

        $usuario->syncPermissions([
            'dashboard-user',
        ]);
    }
}
