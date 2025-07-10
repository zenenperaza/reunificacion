<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Caso;
use App\Models\Configuracion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Familia;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            EstadoSeeder::class,
            MunicipioSeeder::class,
            ParroquiaSeeder::class,
            ConfiguracionSeeder::class, 
            FamiliaSeeder::class,
        ]);


        // Crea los casos después de que existan los datos relacionados
        \App\Models\Caso::factory()->count(1000)->create();
    }
}
