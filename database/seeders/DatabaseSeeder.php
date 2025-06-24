<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Caso;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
     Caso::truncate();

    
        // Caso::factory()->count(100)->create();
    // $this->call([
    //     RoleSeeder::class,
    //     UserSeeder::class,
    //     EstadoSeeder::class,
    //     MunicipioSeeder::class,
    //     ParroquiaSeeder::class,
        
    //     CasoSeeder::class,
    // ]);
}


}
