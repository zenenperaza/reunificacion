<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crear permisos básicos
        $permisos = [
            'ver dashboard',
            'gestionar usuarios',
            'crear casos',
            'editar casos',
            'eliminar casos',
            'ver casos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $usuario = Role::firstOrCreate(['name' => 'usuario']);

        // Asignar todos los permisos al admin
        $admin->syncPermissions(Permission::all());

        // Asignar solo algunos al usuario
        $usuario->syncPermissions([
            'ver dashboard',
            'crear casos',
            'ver casos',
        ]);
    }
}
