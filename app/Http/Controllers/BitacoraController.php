<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class BitacoraController extends Controller
{
    public function index()
    {
        return view('bitacora.index');
    }

    public function data(Request $request)
    {
        return DataTables::eloquent(Activity::with('causer')->latest())
            ->addColumn('usuario', fn($log) => $log->causer->name ?? 'Sistema')
            ->addColumn('fecha', fn($log) => $log->created_at->format('d/m/Y H:i'))
            ->addColumn('modulo', fn($log) => ucfirst($log->log_name))
            ->addColumn('detalles', function ($log) {
                $id = 'accordion-' . $log->id;
                $props = $log->properties->toArray();

                $html = '<div class="accordion" id="accordion-' . $log->id . '">';
                $html .= '<div class="accordion-item">';
                $html .= '<h2 class="accordion-header" id="heading-' . $log->id . '">';
                $html .= '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-' . $log->id . '" aria-expanded="false" aria-controls="collapse-' . $log->id . '">';
                $html .= 'Ver detalles';
                $html .= '</button></h2>';

                $html .= '<div id="collapse-' . $log->id . '" class="accordion-collapse collapse" aria-labelledby="heading-' . $log->id . '" data-bs-parent="#accordion-' . $log->id . '">';
                $html .= '<div class="accordion-body"><ul class="mb-0">';

                foreach ($props['attributes'] ?? [] as $field => $value) {
                    $valor = is_array($value) ? implode(', ', $value) : $value;
                    $html .= "<li><strong>{$field}</strong>: {$valor}</li>";
                }

                foreach ($props as $key => $value) {
                    if (!in_array($key, ['attributes', 'old'])) {
                        $html .= "<li><strong>{$key}</strong>: " . (is_array($value) ? json_encode($value) : $value) . "</li>";
                    }
                }

                $html .= '</ul></div></div></div></div>';

                return $html;
            })
            ->rawColumns(['detalles'])

            ->rawColumns(['detalles'])
            ->make(true);
    }
}
