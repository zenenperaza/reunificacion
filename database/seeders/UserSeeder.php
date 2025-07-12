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
            'name' => 'Zenen Peraza',
            'email' => 'peraza@outlook.com',
            'password' => Hash::make('123456'),
            'phone' => '04245034999',
            'address' => 'Dirección Central',
            'estatus' => 'activo',
        ]);
        $admin->assignRole('Administrador');

        // Crear trabajador
        $trabajador = User::create([
            'name' => 'Mary Melendez',
            'email' => 'mmelendez@asonacop.org',
            'password' => Hash::make('123456'),
            'estatus' => 'activo',
        ]);
        $trabajador->assignRole('Administrador');

        
        // Crear trabajador
        $trabajador = User::create([
            'name' => 'Danny Primera',
            'email' => 'dannyprimera@gmail.com',
            'password' => Hash::make('123456'),
            'estatus' => 'activo',
        ]);
        $trabajador->assignRole('Monitor');
    }
}
