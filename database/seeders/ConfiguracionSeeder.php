<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConfiguracionSeeder extends Seeder
{
    public function run()
    {
        // Imagen de portada por defecto
        $rutaPortada = storage_path('app/public/portada/default.png');
        $imagenPortada = null;

        if (file_exists($rutaPortada)) {
            $nombrePortada = 'portada/' . Str::random(10) . '.png';
            Storage::disk('public')->put($nombrePortada, file_get_contents($rutaPortada));
            $imagenPortada = $nombrePortada;
        }

        // Logo del sistema por defecto
        $rutaLogo = storage_path('app/public/logos/default.png');
        $logoSistema = null;

        if (file_exists($rutaLogo)) {
            $nombreLogo = 'logos/' . Str::random(10) . '.png';
            Storage::disk('public')->put($nombreLogo, file_get_contents($rutaLogo));
            $logoSistema = $nombreLogo;
        }

        Configuracion::updateOrCreate(
            ['id' => 1],
            [
                'conf_fecha_actual' => 'no',
                'sistema_deshabilitado' => 'no',
                'periodo' => now()->format('Y-m'),
                'prefijo_caso' => 'CAMSEG',
                'nombre_sistema' => 'Sistema Caminoseguro',
                'texto_portada' => 'Un esfuerzo de ASONACOP para reunir a niñas, niños y adolescentes con sus familias.',
                'logo_sistema' => $logoSistema,
                'imagen_portada' => $imagenPortada,
            ]
        );
    }
}
