<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            ['nombre' => 'Amazonas', 'codigo_iso' => 've-am'],
            ['nombre' => 'Anzoátegui', 'codigo_iso' => 've-an'],
            ['nombre' => 'Apure', 'codigo_iso' => 've-ap'],
            ['nombre' => 'Aragua', 'codigo_iso' => 've-ar'],
            ['nombre' => 'Barinas', 'codigo_iso' => 've-ba'],
            ['nombre' => 'Bolívar', 'codigo_iso' => 've-bo'],
            ['nombre' => 'Carabobo', 'codigo_iso' => 've-ca'],
            ['nombre' => 'Cojedes', 'codigo_iso' => 've-co'],
            ['nombre' => 'Delta Amacuro', 'codigo_iso' => 've-da'],
            ['nombre' => 'Distrito Capital', 'codigo_iso' => 've-dc'],
            ['nombre' => 'Falcón', 'codigo_iso' => 've-fa'],
            ['nombre' => 'Guárico', 'codigo_iso' => 've-gu'],
            ['nombre' => 'Lara', 'codigo_iso' => 've-la'],
            ['nombre' => 'Mérida', 'codigo_iso' => 've-me'],
            ['nombre' => 'Miranda', 'codigo_iso' => 've-mi'],
            ['nombre' => 'Monagas', 'codigo_iso' => 've-mo'],
            ['nombre' => 'Nueva Esparta', 'codigo_iso' => 've-ne'],
            ['nombre' => 'Portuguesa', 'codigo_iso' => 've-po'],
            ['nombre' => 'Sucre', 'codigo_iso' => 've-su'],
            ['nombre' => 'Táchira', 'codigo_iso' => 've-ta'],
            ['nombre' => 'Trujillo', 'codigo_iso' => 've-tr'],
            ['nombre' => 'La Guaira', 'codigo_iso' => 've-vg'], // Ex Vargas
            ['nombre' => 'Yaracuy', 'codigo_iso' => 've-ya'],
            ['nombre' => 'Zulia', 'codigo_iso' => 've-zu'],
        ];

        foreach ($estados as $estado) {
            Estado::updateOrCreate(
                ['nombre' => $estado['nombre']],
                ['codigo_iso' => $estado['codigo_iso']]
            );
        }
    }
}


