<?php

// database/seeders/ConfiguracionSeeder.php

use App\Models\Configuracion;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    public function run()
    {
        Configuracion::updateOrCreate([
            'clave' => 'nombre_sistema',
        ], [
            'valor' => 'Sistema de Reunificación ASONACOP',
            'descripcion' => 'Nombre que se muestra en el header y título del sistema.',
        ]);
    }
}
