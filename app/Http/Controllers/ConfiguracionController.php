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

    public function update(Request $request, Configuracion $configuracion)
    {
        $request->validate([
            'valor' => 'required',
        ]);

        $configuracion->valor = $request->input('valor');
        $configuracion->save();

        return redirect()->back()->with('success', 'Configuración actualizada.');
    }
}
