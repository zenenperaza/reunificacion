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
             // Municipio: Andrés Bello (ID = 63)
            ['nombre' => 'La Palmita', 'municipio_id' => 63],

            // Municipio: Antonio Rómulo Costa (ID = 64)
            ['nombre' => 'Las Mesas', 'municipio_id' => 64],

            // Municipio: Ayacucho (ID = 65)
            ['nombre' => 'Colón', 'municipio_id' => 65],
            ['nombre' => 'Rivas Berti', 'municipio_id' => 65],
            ['nombre' => 'San Pedro del Río', 'municipio_id' => 65],

            // Municipio: Bolívar (ID = 66)
            ['nombre' => 'San Antonio del Táchira', 'municipio_id' => 66],
            ['nombre' => 'Isaías Medina Angarita', 'municipio_id' => 66],

            // Municipio: Cárdenas (ID = 67)
            ['nombre' => 'Amenodoro Rangel Lamus', 'municipio_id' => 67],
            ['nombre' => 'La Florida', 'municipio_id' => 67],
            ['nombre' => 'Táriba', 'municipio_id' => 67],

            // Municipio: Córdoba (ID = 68)
            ['nombre' => 'Santa Ana', 'municipio_id' => 68],

            // Municipio: Fernández Feo (ID = 69)
            ['nombre' => 'Alberto Adriani', 'municipio_id' => 69],
            ['nombre' => 'Santo Domingo', 'municipio_id' => 69],
            ['nombre' => 'San Rafael de El Piñal', 'municipio_id' => 69],

            // Municipio: Francisco de Miranda (ID = 70)
            ['nombre' => 'San José de Bolívar', 'municipio_id' => 70],

            // Municipio: García de Hevia (ID = 71)
            ['nombre' => 'Boca de Grita', 'municipio_id' => 71],
            ['nombre' => 'José Antonio Páez', 'municipio_id' => 71],
            ['nombre' => 'La Fría', 'municipio_id' => 71],

            // Municipio: Guásimos (ID = 72)
            ['nombre' => 'Palmira', 'municipio_id' => 72],

            // Municipio: Independencia (ID = 73)
            ['nombre' => 'Capacho Nuevo', 'municipio_id' => 73],

            // Municipio: Jáuregui (ID = 74)
            ['nombre' => 'La Grita', 'municipio_id' => 74],

            // Municipio: José María Vargas (ID = 75)
            ['nombre' => 'El Cobre', 'municipio_id' => 75],

            // Municipio: Junín (ID = 76)
            ['nombre' => 'Rubio', 'municipio_id' => 76],
            ['nombre' => 'Bramón', 'municipio_id' => 76],

            // Municipio: Libertad (ID = 77)
            ['nombre' => 'Capacho Viejo', 'municipio_id' => 77],

            // Municipio: Libertador (ID = 78)
            ['nombre' => 'Abejales', 'municipio_id' => 78],

            // Municipio: Lobatera (ID = 79)
            ['nombre' => 'Lobatera', 'municipio_id' => 79],
            ['nombre' => 'Constitución', 'municipio_id' => 79],

            // Municipio: Michelena (ID = 80)
            ['nombre' => 'Michelena', 'municipio_id' => 80],

            // Municipio: Panamericano (ID = 81)
            ['nombre' => 'Coloncito', 'municipio_id' => 81],

            // Municipio: Pedro María Ureña (ID = 82)
            ['nombre' => 'Ureña', 'municipio_id' => 82],

            // Municipio: Rafael Urdaneta (ID = 83)
            ['nombre' => 'Delicias', 'municipio_id' => 83],

            // Municipio: Samuel Darío Maldonado (ID = 84)
            ['nombre' => 'La Tendida', 'municipio_id' => 84],

            // Municipio: San Cristóbal (ID = 85)
            ['nombre' => 'La Concordia', 'municipio_id' => 85],
            ['nombre' => 'San Juan Bautista', 'municipio_id' => 85],
            ['nombre' => 'Pedro María Morantes', 'municipio_id' => 85],
            ['nombre' => 'San Sebastián', 'municipio_id' => 85],
            ['nombre' => 'Francisco Romero Lobo', 'municipio_id' => 85],

            // Municipio: Seboruco (ID = 86)
            ['nombre' => 'Seboruco', 'municipio_id' => 86],

            // Municipio: Simón Rodríguez (ID = 87)
            ['nombre' => 'San Simón', 'municipio_id' => 87],

            // Municipio: Sucre (ID = 88)
            ['nombre' => 'Queniquea', 'municipio_id' => 88],

            // Municipio: Torbes (ID = 89)
            ['nombre' => 'San Josecito', 'municipio_id' => 89],

            // Municipio: Uribante (ID = 90)
            ['nombre' => 'Pregonero', 'municipio_id' => 90],

            // Municipio: San Judas Tadeo (ID = 91)
            ['nombre' => 'Umuquena', 'municipio_id' => 91],
        ];

        Parroquia::insert($parroquias);
    }
}

