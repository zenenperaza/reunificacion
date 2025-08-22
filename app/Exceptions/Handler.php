<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [];

    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        //
    }

public function render($request, Throwable $exception)
{
    if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
        // Para peticiones normales
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'Sesión expirada. Por favor, inicia sesión de nuevo.'], 419);
        }

        // Para peticiones POST, GET, etc.
        return redirect()->route('login')
            ->with('message', 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
    }

    return parent::render($request, $exception);
}

}
