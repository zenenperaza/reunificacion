<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Admin Principal',
            'email' => 'peraza@outlook.com',
            'password' => Hash::make('123456'),
            'phone' => '0000000000',
            'address' => 'Dirección Central',
            'estatus' => 'activo',
        ]);
        $admin->assignRole('admin');

        // Crear trabajador
        $trabajador = User::create([
            'name' => 'Trabajador 1',
            'email' => 'trabajador1@reunificacion.com',
            'password' => Hash::make('123456'),
            'estatus' => 'activo',
        ]);
        $trabajador->assignRole('usuario');
    }
}
