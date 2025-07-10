<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Familia;

class FamiliaSeeder extends Seeder
{
    public function run(): void
    {
        $familias = [
            ['nombre' => 'Zulia', 'ver_entre_hermanos' => true],
            ['nombre' => 'Táchira', 'ver_entre_hermanos' => false],
            ['nombre' => 'Caracas', 'ver_entre_hermanos' => true],
            ['nombre' => 'Monagas', 'ver_entre_hermanos' => false],
        ];

        foreach ($familias as $familia) {
            Familia::create($familia);
        }
    }
}
