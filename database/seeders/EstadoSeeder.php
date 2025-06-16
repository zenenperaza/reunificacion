<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            'Amazonas',
            'Anzoátegui',
            'Apure',
            'Aragua',
            'Barinas',
            'Bolívar',
            'Carabobo',
            'Cojedes',
            'Delta Amacuro',
            'Distrito Capital',
            'Falcón',
            'Guárico',
            'Lara',
            'Mérida',
            'Miranda',
            'Monagas',
            'Nueva Esparta',
            'Portuguesa',
            'Sucre',
            'Táchira',
            'Trujillo',
            'La Guaira',
            'Yaracuy',
            'Zulia'
        ];

        foreach ($estados as $nombre) {
            Estado::create(['nombre' => $nombre]);
        }
    }
}

