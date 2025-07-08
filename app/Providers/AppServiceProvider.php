<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View; // ✅ Importar View
use Carbon\Carbon;
use App\Models\Configuracion;
use App\Models\Caso;

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

        // ✅ Notificaciones de casos en espera
        View::composer('partials.header', function ($view) {
            $view->with('notificaciones', Caso::enEspera());
            $view->with('cantidadNotificaciones', Caso::cantidadEnEspera());
        });
    }
}
