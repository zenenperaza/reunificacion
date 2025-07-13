<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caso;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // arriba

class DashboardController extends Controller
{

    public function index()
    {
        // Definiciones de género por texto en campo 'beneficiario'
        $masculinoValores = ['Niño adolescente', 'Hombre joven', 'Hombre adulto'];
        $femeninoValores = ['Niña adolescente', 'Mujer joven', 'Mujer adulta'];
        
        $casosTotal = Caso::count();
        $masculino = Caso::whereIn('beneficiario', $masculinoValores)->count();
        $femenino = Caso::whereIn('beneficiario', $femeninoValores)->count();

        $totales = [
            'casos' => $casosTotal,
            'masculino' => $masculino,
            'femenino' => $femenino,
            'masculino_pct' => $casosTotal > 0 ? round(($masculino / $casosTotal) * 100, 1) : 0,
            'femenino_pct' => $casosTotal > 0 ? round(($femenino / $casosTotal) * 100, 1) : 0,
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
                'mes' => $fecha->translatedFormat('M Y'),
                'total' => $total
            ]);
        }

        // Casos por beneficiario
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

        // Casos para el mapa por estado (códigos ISO)
        $mapaEstados = DB::table('casos')
            ->join('estados', 'casos.estado_destino_id', '=', 'estados.id')
            ->select('estados.codigo_iso', DB::raw('count(*) as total'))
            ->groupBy('estados.codigo_iso')
            ->pluck('total', 'codigo_iso');

        // dd($mapaEstados);
        $topEstados = DB::table('casos')
            ->join('estados', 'casos.estado_destino_id', '=', 'estados.id')
            ->select('estados.nombre', DB::raw('count(*) as total'))
            ->whereNotNull('casos.estado_destino_id')
            ->groupBy('estados.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();


        return view('dashboard.index', compact(
            'totales',
            'porEstado',
            'porTipoAtencion',
            'ultimosMeses',
            'porBeneficiario',
            'mapaEstados',
            'topEstados',
        ));
    }

    public function usuario()
    {
        return view('dashboard-user');
    }
}
