<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Models\Configuracion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Establecer el locale para Carbon a español
        setlocale(LC_TIME, 'es_ES.UTF-8');
        Carbon::setLocale('es');

        // ✅ Cargar nombre del sistema desde la base de datos
        if (Schema::hasTable('configuraciones')) {
            $nombreSistema = Configuracion::first()?->nombre_sistema ?? 'Sistema RLF';
            config(['app.name' => $nombreSistema]);
        }
    }
}
