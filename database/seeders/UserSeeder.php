<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Usuario administrador principal
        $admin = User::create([
            'name' => 'Zenen Peraza',
            'email' => 'peraza@outlook.com',
            'password' => Hash::make('123456'),
            'phone' => '04245034999',
            'address' => 'Dirección Central',
            'estatus' => 'activo',
        ]);
        $admin->assignRole('Administrador');

        // Otros usuarios ya encriptados
        $usuarios = [
            [
                'id' => 4,
                'name' => 'monitoreonacional',
                'email' => 'mmelendez@asonacop.org',
                'password' => '$2y$12$h7UDxzcvtGtDfRiotJsYQulO90dkZ2K3e5oufh5ti2k6msB63NBoi',
                'estatus' => 'activo',
                'es_superior' => false,
                'created_at' => '2025-07-01 02:22:02',
                'updated_at' => '2025-07-28 09:46:17',
            ],
            [
                'id' => 5,
                'name' => 'Danny',
                'email' => 'dannyprimera@gmail.com',
                'password' => '$2y$12$BF30tYqbYstWE2fD6sBRQemIED.GN9o9VcGys8YscDHfZXqMeBnhO',
                'estatus' => 'activo',
                'es_superior' => false,
                'created_at' => '2025-07-01 02:46:07',
                'updated_at' => '2025-07-21 18:25:13',
            ],
            [
                'id' => 6,
                'name' => 'Jesus Villarroel',
                'email' => 'soporteit@asonacop.org',
                'password' => '$2y$12$ErrIN7bMOZcLxlqR4NglFeho4RdI5kRnPuWBYqsws71jQ/3zzGCUa',
                'estatus' => 'activo',
                'es_superior' => false,
                'created_at' => '2025-07-04 00:59:51',
                'updated_at' => '2025-07-21 18:25:32',
            ],
            [
                'id' => 7,
                'name' => 'Lily Torres',
                'email' => 'lilytorres@asonacop.org',
                'password' => '$2y$12$yKORccprRj8xV/Ev22Db2uPtTYtim22WKlR4kpkhdoiT6Nc6GWeVa',
                'estatus' => 'activo',
                'es_superior' => false,
                'created_at' => '2025-07-28 09:44:16',
                'updated_at' => '2025-07-28 09:45:59',
            ],
            [
                'id' => 8,
                'name' => 'Yohana Moros',
                'email' => 'pocha2207@hotmail.com',
                'password' => '$2y$12$BdnrOCTNs75pFKusLQGhhe1dcim57HCo52svDgOUWqNhSuT3mQSN6',
                'estatus' => 'activo',
                'es_superior' => false,
                'created_at' => '2025-07-30 09:25:59',
                'updated_at' => '2025-07-30 09:29:08',
            ],
        ];

        foreach ($usuarios as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
