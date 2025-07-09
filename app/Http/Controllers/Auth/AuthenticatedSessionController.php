<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */


    public function create(): View
    {

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($request->only('email', 'password'), $remember)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Verificar estatus
        if ($user->estatus !== 'activo') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Tu cuenta está inactiva.',
            ]);
        }

        // Redirección por rol
        if ($user->hasRole('Usuario')) {
            return redirect()->route('dashboard.user');
        }

        return redirect()->route('dashboard'); // Ruta general por defecto
    }

    return back()->withErrors([
        'email' => trans('auth.failed'),
    ]);
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
