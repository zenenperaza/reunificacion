<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Principal',
            'email' => 'peraza@outlook.com',
            'password' => Hash::make('123456'),
            'phone' => '0000000000',
            'address' => 'Dirección Central',
            'role_id' => 1, // Administrador
            'estatus' => 'activo',
        ]);

        User::create([
            'name' => 'Trabajador 1',
            'email' => 'trabajador1@reunificacion.com',
            'password' => Hash::make('123456'),
            'role_id' => 3,
            'estatus' => 'activo',
        ]);
    }
}
