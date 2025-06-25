<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caso;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Definiciones de género por texto en campo 'beneficiario'
        $masculinoValores = ['Niño adolescente', 'Hombre joven', 'Hombre adulto'];
        $femeninoValores = ['Niña adolescente', 'Mujer joven', 'Mujer adulta'];

        // Totales generales
        $totales = [
            'casos' => Caso::count(),
            'casosCount' => Caso::count(),
            'masculino' => Caso::whereIn('beneficiario', $masculinoValores)->count(),
            'femenino' => Caso::whereIn('beneficiario', $femeninoValores)->count(),
            'mes_actual' => Caso::whereMonth('fecha_actual', now()->month)->whereYear('fecha_actual', now()->year)->count(),
        ];

        // Casos por estado
        $porEstado = Caso::selectRaw('estados.nombre as estado, count(*) as total')
            ->join('estados', 'casos.estado_id', '=', 'estados.id')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        // Casos por tipo de atención
        $porTipoAtencion = Caso::selectRaw('tipo_atencion, count(*) as total')
            ->groupBy('tipo_atencion')
            ->pluck('total', 'tipo_atencion');

        // Casos por mes (últimos 6 meses)
        $ultimosMeses = collect();
        for ($i = 5; $i >= 0; $i--) {
            $fecha = now()->subMonths($i);
            $inicio = $fecha->copy()->startOfMonth();
            $fin = $fecha->copy()->endOfMonth();

            $total = Caso::whereBetween('fecha_actual', [$inicio, $fin])->count();

            $ultimosMeses->push([
                'mes' => $fecha->translatedFormat('M Y'), // Ej: Ene 2025 (en español si configuras locale)
                'total' => $total
            ]);
        }

        $porBeneficiario = Caso::selectRaw('beneficiario, COUNT(*) as total')
            ->whereIn('beneficiario', [
                'Niña adolescente',
                'Mujer joven',
                'Mujer adulta',
                'Niño adolescente',
                'Hombre joven',
                'Hombre adulto',
            ])
            ->groupBy('beneficiario')
            ->pluck('total', 'beneficiario');


        return view('dashboard.index', compact(
            'totales',
            'porEstado',
            'porTipoAtencion',
            'ultimosMeses',
            'porBeneficiario'
        ));
    }
}
