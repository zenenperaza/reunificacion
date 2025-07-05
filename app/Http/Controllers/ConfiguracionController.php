<?php

// app/Http/Controllers/ConfiguracionController.php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('admin.configuraciones.index', compact('configuraciones'));
    }

public function update(Request $request)
{
    $request->validate([
        'conf_fecha_actual' => 'required|in:si,no',
    ]);

    Configuracion::updateOrCreate(
        ['clave' => 'conf_fecha_actual'],
        ['valor' => $request->conf_fecha_actual]
    );

    return redirect()->back()->with('success', 'Configuración actualizada correctamente.');
}

}
