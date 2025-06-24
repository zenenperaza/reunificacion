<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;


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
        setlocale(LC_TIME, 'es_ES.UTF-8'); // para formatos de fecha tradicionales
        Carbon::setLocale('es'); // para métodos de Carbon como translatedFormat()
    }
}
