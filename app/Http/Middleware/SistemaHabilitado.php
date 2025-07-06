<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SistemaHabilitado
{
    public function handle(Request $request, Closure $next): Response
    {
        $config = \App\Models\Configuracion::first();

        // Si el sistema está deshabilitado y el usuario NO tiene el permiso...
        if ($config && $config->sistema_deshabilitado === 'si' && !auth()->user()?->can('sistema deshabilitado')) {
            // Mostrar dashboard vacío o redirigir a una vista limitada
            return response()->view('sistema.bloqueado');
        }

        return $next($request);
    }
}
