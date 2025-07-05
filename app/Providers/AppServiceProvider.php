<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Spatie\Backup\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;

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

    }
}
