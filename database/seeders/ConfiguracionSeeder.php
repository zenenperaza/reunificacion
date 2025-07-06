<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    public function run(): void
    {
        Configuracion::firstOrCreate([], [
            'conf_fecha_actual' => 'no',
            'sistema_deshabilitado' => 'no',
            'periodo' => now()->format('Y-m'),
            'nombre_sistema' => 'Sistema RLF',
        ]);
    }
}
