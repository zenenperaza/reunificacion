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
            'ver casos',
            'ver roles',
            'editar roles',
            'crear roles',
            'eliminar roles',
            'ver usuarios',
            'editar usuarios',
            'crear usuarios',
            'eliminar usuarios',
            'Gestion usuarios',
            'Gestion roles',
            'Gestion permisos',
            'Gestion configuracion',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $usuario = Role::firstOrCreate(['name' => 'Usuario']);

        $admin->syncPermissions(Permission::all());

        $usuario->syncPermissions([
            'dashboard-user',
        ]);
    }
}
