<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LockScreenMiddleware
{
   public function handle(Request $request, Closure $next)
{
    logger('Middleware ejecutado en: ' . $request->path());
    
    if (Auth::check() && session('locked') && !$request->is('lock') && !$request->is('unlock')) {
        return redirect('/lock');
    }

    return $next($request);
}

}
