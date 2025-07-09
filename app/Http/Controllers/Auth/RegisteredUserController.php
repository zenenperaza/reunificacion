<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Notifications\NuevoUsuarioRegistrado;
use Illuminate\Support\Facades\Notification;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estatus' => 'activo', // opcional si lo usas en tu modelo
        ]);

        // ✅ Asignar automáticamente el rol "Usuario"
        $user->assignRole('Usuario');

        // Enviar correo a destinatario fijo
        Notification::route('mail', 'mmelendezasonacop@gmail.com') // ← Cambia por el correo deseado
            ->notify(new NuevoUsuarioRegistrado($user));


        event(new Registered($user));

        Auth::login($user);

        if (Auth::user()->hasRole('Usuario')) {
            return redirect()->route('dashboard.user');
        } else {
            return redirect()->route('dashboard');
        }
    }
}
