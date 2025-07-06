<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $config = Configuracion::first(); // Asumes que solo hay una fila
        return view('admin.configuraciones.index', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'conf_fecha_actual' => 'required|in:si,no',
            'sistema_deshabilitado' => 'required|in:si,no',
            'periodo' => 'required|date_format:Y-m',
            'nombre_sistema' => 'nullable|string|max:255',
            'logo_sistema' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $config = Configuracion::first();

        if (!$config) {
            $config = new Configuracion(); // Por si no existe aún
        }

        $config->conf_fecha_actual = $request->conf_fecha_actual;
        $config->sistema_deshabilitado = $request->sistema_deshabilitado;
        $config->periodo = $request->periodo;
        $config->nombre_sistema = $request->nombre_sistema;

        // Si subieron un nuevo logo
        if ($request->hasFile('logo_sistema')) {
            // Opcional: eliminar logo anterior si existe
            if ($config->logo_sistema && Storage::disk('public')->exists($config->logo_sistema)) {
                Storage::disk('public')->delete($config->logo_sistema);
            }

            $path = $request->file('logo_sistema')->store('logos', 'public');
            $config->logo_sistema = $path;
        }

        $config->save();

        return redirect()->back()->with('success', 'Configuración actualizada correctamente.');
    }
}
