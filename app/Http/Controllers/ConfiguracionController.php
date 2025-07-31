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
            'prefijo_caso' => 'nullable|string|max:10',
            'nombre_sistema' => 'nullable|string|max:255',
            'texto_portada' => 'nullable|string',
            'logo_sistema' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'imagen_portada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $config = Configuracion::first() ?? new Configuracion();

        $config->conf_fecha_actual = $request->conf_fecha_actual;
        $config->sistema_deshabilitado = $request->sistema_deshabilitado;
        $config->periodo = $request->periodo;
        $config->prefijo_caso = $request->prefijo_caso;
        $config->nombre_sistema = $request->nombre_sistema;
        $config->texto_portada = $request->texto_portada;

        // ✔️ Cargar nuevo logo si se subió
        if ($request->hasFile('logo_sistema')) {
            if ($config->logo_sistema && Storage::disk('public')->exists($config->logo_sistema)) {
                Storage::disk('public')->delete($config->logo_sistema);
            }
            $config->logo_sistema = $request->file('logo_sistema')->store('logos', 'public');
        }

        // ✔️ Cargar nueva imagen de portada si se subió
        if ($request->hasFile('imagen_portada')) {
            if ($config->imagen_portada && Storage::disk('public')->exists($config->imagen_portada)) {
                Storage::disk('public')->delete($config->imagen_portada);
            }
            $config->imagen_portada = $request->file('imagen_portada')->store('portada', 'public');
        }

        $config->save();

        return redirect()->back()->with('success', '✅ Configuración actualizada correctamente.');
    }
}
