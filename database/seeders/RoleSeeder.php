<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Todos los permisos disponibles
        $todosLosPermisos = [
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

            'ver coordinaciones',
            'crear coordinaciones',
            'editar coordinaciones',
            'eliminar coordinaciones',

            'Gestion donantes',
            'ver donantes',
            'editar donantes',
            'crear donantes',
            'eliminar donantes',
            
            'dashboard-user', 
        ];

           $permisosMonitor = [
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

            'ver coordinaciones',
            'crear coordinaciones',
            'editar coordinaciones',
            'eliminar coordinaciones',

            'Gestion donantes',
            
        ];

        // Permisos específicos para Coordinador
        $permisosCoordinador = [
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
        ];

        // Crear todos los permisos si no existen
        foreach ($todosLosPermisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $coordinador = Role::firstOrCreate(['name' => 'Coordinador']);        
        $puntofocal = Role::firstOrCreate(['name' => 'Punto focal']);       
        $monitor = Role::firstOrCreate(['name' => 'Monitor']);
        $usuario = Role::firstOrCreate(['name' => 'Usuario']);

        // Asignación de permisos
        $admin->syncPermissions(Permission::all());
        

        // Solo los permisos específicos para el Coordinador, Monitor y Punto focal        
        $monitor->syncPermissions($permisosMonitor);

        $coordinador->syncPermissions($permisosCoordinador);
        $puntofocal->syncPermissions($permisosCoordinador);

        // Usuario básico
        $usuario->syncPermissions([
            'dashboard-user',
        ]);
    }
}
