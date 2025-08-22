<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LockScreenController extends Controller
{
    public function show()
    {
        session(['locked' => true]);
        session()->save(); // 👈 fuerza guardado inmediato
        return view('auth.lock');
    }

    public function unlock(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Tu sesión ha expirado. Inicia sesión nuevamente.');
        }

        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::user();

        if ($user && Hash::check($request->password, $user->password)) {
            session()->forget('locked');
            return redirect('/dashboard');
        }

        return back()->withErrors(['password' => 'Contraseña incorrecta']);
    }


    // public function unlock(Request $request)
    // {
    //     $request->validate([
    //         'password' => 'required'
    //     ]);

    //     $user = Auth::user();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         session()->forget('locked');
    //         return redirect('/dashboard');
    //     }

    //     return back()->withErrors(['password' => 'Contraseña incorrecta']);
    // }
}
