<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caso;

class BusquedaController extends Controller
{
    /**
     * Mostrar la vista de resultados de búsqueda (formulario completo).
     */
    public function resultados(Request $request)
    {
        $search = $request->input('search');

        $query = Caso::query();

        if ($search) {
            $query->where('beneficiario', 'like', "%{$search}%")
                  ->orWhere('tipo_atencion', 'like', "%{$search}%")
                  ->orWhere('observaciones', 'like', "%{$search}%")
                  ->orWhere('numero_caso', 'like', "%{$search}%");
        }

        // Puedes ajustar el número (ej: 100) o usar get() si prefieres sin paginar
       $resultados = $query->get(); // 🔥 Sin paginación: trae todos los resultados


        return view('busqueda.resultados', compact('resultados', 'search'));
    }

    /**
     * Respuesta JSON para la búsqueda en vivo vía AJAX (input superior).
     */
    public function ajax(Request $request)
    {
        $term = $request->input('term');

        $resultados = Caso::where('beneficiario', 'LIKE', "%{$term}%")
            ->orWhere('tipo_atencion', 'LIKE', "%{$term}%")
            ->orWhere('observaciones', 'LIKE', "%{$term}%")
            ->orWhere('numero_caso', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get();

        return response()->json($resultados);
    }
}
