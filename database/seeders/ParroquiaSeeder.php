<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parroquia;

class ParroquiaSeeder extends Seeder
{
    public function run(): void
    {
        $parroquias = [
            // Municipio: Atabapo (ID = 1)
            ['nombre' => 'San Fernando de Atabapo', 'municipio_id' => 1],
            ['nombre' => 'Ucata', 'municipio_id' => 1],
            ['nombre' => 'Yapacana', 'municipio_id' => 1],

            // Municipio: Atures (ID = 2)
            ['nombre' => 'Luis Alberto Gómez', 'municipio_id' => 2],
            ['nombre' => 'Parhueña', 'municipio_id' => 2],
            ['nombre' => 'San José de Maipures', 'municipio_id' => 2],
            ['nombre' => 'Virgen del Carmen', 'municipio_id' => 2],

            // Municipio: Autana (ID = 3)
            ['nombre' => 'Sipapo', 'municipio_id' => 3],
            ['nombre' => 'Munduapo', 'municipio_id' => 3],
            ['nombre' => 'Guayapo', 'municipio_id' => 3],

            // Municipio: Manapiare (ID = 4)
            ['nombre' => 'Alto Ventuari', 'municipio_id' => 4],
            ['nombre' => 'Medio Ventuari', 'municipio_id' => 4],
            ['nombre' => 'Bajo Ventuari', 'municipio_id' => 4],

            // Municipio: Maroa (ID = 5)
            ['nombre' => 'Victorino', 'municipio_id' => 5],
            ['nombre' => 'Casiquiare', 'municipio_id' => 5],
        ];

        Parroquia::insert($parroquias);
    }
}

