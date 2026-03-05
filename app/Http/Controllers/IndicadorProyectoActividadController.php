<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\ActividadIndicador;
use App\Models\IndicadorProyecto;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IndicadorProyectoActividadController extends Controller
{
    public function index(IndicadorProyecto $indicadorProyecto)
    {
        $indicadorProyecto->load([
            'proyecto:id,codigo',
            'indicador:id,codigo,descripcion',
        ]);

        $actividades = Actividad::orderBy('codigo')->get(['id', 'codigo', 'descripcion']);

        return view('indicador_proyecto.actividades.index', compact('indicadorProyecto', 'actividades'));
    }

    public function data(IndicadorProyecto $indicadorProyecto)
    {
        $query = ActividadIndicador::with('actividad:id,codigo,descripcion')
            ->where('indicador_proyecto_id', $indicadorProyecto->id);

        return DataTables::of($query)
            ->addColumn('codigo', fn($ai) => $ai->actividad?->codigo ?? '-')
            ->addColumn('descripcion', fn($ai) => $ai->actividad?->descripcion ?? '-')
            ->addColumn('estatus_html', function ($ai) {
                $checked = $ai->estatus ? 'checked' : '';
                $label = $ai->estatus ? 'Activo' : 'Inactivo';

                return '<input type="checkbox" class="switch-ai" data-id="' . $ai->id . '" ' . $checked . '>
                        <span class="ms-2 switch-label ' . ($ai->estatus ? 'text-success' : 'text-danger') . '">' . $label . '</span>';
            })
            ->addColumn('acciones', function ($ai) {

                $botones = '<div class="acciones-btns d-flex justify-content-center gap-1">';

                // ✅ BOTÓN NIVEL 3: Servicios
                $botones .= '<a href="' . route('actividadindicador.servicios.index', $ai->id) . '"
                    class="btn btn-sm btn-primary"
                    title="Servicios">
                    <i class="mdi mdi-briefcase-outline"></i>
                 </a>';

                // Editar meta (modal)
                $botones .= '<button class="btn btn-sm btn-warning btn-edit"
                    title="Editar meta"
                    data-id="' . $ai->id . '"
                    data-meta="' . $ai->meta . '">
                    <i class="mdi mdi-pencil"></i>
                 </button>';

                // Eliminar vínculo
                $botones .= '<button class="btn btn-sm btn-danger btn-delete"
                    title="Quitar"
                    data-url="' . route('indicadorproyecto.actividades.destroy', $ai->id) . '"
                    data-nombre="Actividad ' . e(optional($ai->actividad)->codigo) . '">
                    <i class="mdi mdi-trash-can-outline"></i>
                 </button>';

                $botones .= '</div>';

                return $botones;
            })
            ->rawColumns(['estatus_html', 'acciones'])
            ->make(true);
    }

    public function store(Request $request, IndicadorProyecto $indicadorProyecto)
    {
        $request->validate([
            'actividad_id' => 'required|exists:actividades,id',
            'meta' => 'nullable|numeric|min:0',
        ]);

        $exists = ActividadIndicador::where('indicador_proyecto_id', $indicadorProyecto->id)
            ->where('actividad_id', $request->actividad_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Esa actividad ya está asignada a este indicador.');
        }

        ActividadIndicador::create([
            'indicador_proyecto_id' => $indicadorProyecto->id,
            'actividad_id' => $request->actividad_id,
            'meta' => $request->meta,
            'estatus' => true,
        ]);

        return back()->with('success', 'Actividad agregada al indicador.');
    }

    public function update(Request $request, ActividadIndicador $actividadIndicador)
    {
        $request->validate([
            'meta' => 'nullable|numeric|min:0',
        ]);

        $actividadIndicador->update([
            'meta' => $request->meta,
        ]);

        return response()->json(['ok' => true]);
    }

    public function toggleEstatus(ActividadIndicador $actividadIndicador)
    {
        $actividadIndicador->estatus = !$actividadIndicador->estatus;
        $actividadIndicador->save();

        return response()->json(['ok' => true, 'estatus' => $actividadIndicador->estatus]);
    }

    public function destroy(ActividadIndicador $actividadIndicador)
    {
        $actividadIndicador->delete();
        return redirect()->back()->with('success', 'Actividad desvinculada.');
    }
}
