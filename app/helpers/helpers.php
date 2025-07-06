<?php

use App\Models\Configuracion;

if (!function_exists('configuracion')) {
    function configuracion(string $clave): mixed
    {
        $config = Configuracion::first(); // CORRECTO: usamos Eloquent directamente
        return $config->{$clave} ?? null;
    }
}
