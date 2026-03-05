<?php

namespace App\Http\Controllers;

use App\Models\ActividadIndicador;
use App\Models\Servicio;
use App\Models\ServicioActividad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActividadIndicadorServicioController extends Controller
{
    public function index(ActividadIndicador $actividadIndicador)
    {
        $actividadIndicador->load([
            'indicadorProyecto.proyecto:id,codigo',
            'indicadorProyecto.indicador:id,codigo,descripcion',
            'actividad:id,codigo,descripcion',
        ]);

        $servicios = Servicio::orderBy('descripcion')->get(['id','descripcion']);

        return view('actividad_indicador.servicios.index', compact('actividadIndicador','servicios'));
    }

    public function data(ActividadIndicador $actividadIndicador)
    {
        $query = ServicioActividad::with('servicio:id,descripcion')
            ->where('actividad_indicador_id', $actividadIndicador->id);

        return DataTables::of($query)
            ->addColumn('descripcion', fn($sa) => $sa->servicio?->descripcion ?? '-')
            ->addColumn('estatus_html', function ($sa) {
                $checked = $sa->estatus ? 'checked' : '';
                $label = $sa->estatus ? 'Activo' : 'Inactivo';

                return '<input type="checkbox" class="switch-sa" data-id="'.$sa->id.'" '.$checked.'>
                        <span class="ms-2 switch-label '.($sa->estatus?'text-success':'text-danger').'">'.$label.'</span>';
            })
            ->addColumn('acciones', function ($sa) {
                $btn = '<div class="d-flex justify-content-center gap-1">';

                $btn .= '<button class="btn btn-sm btn-warning btn-edit"
                            data-id="'.$sa->id.'"
                            data-cantidad="'.$sa->cantidad_disponible.'"
                            title="Editar cantidad">
                            <i class="mdi mdi-pencil"></i>
                         </button>';

                $btn .= '<button class="btn btn-sm btn-danger btn-delete"
                            data-url="'.route('actividadindicador.servicios.destroy', $sa->id).'"
                            data-nombre="Servicio '.e($sa->servicio?->descripcion ?? '').'"
                            title="Quitar">
                            <i class="mdi mdi-trash-can-outline"></i>
                         </button>';

                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['estatus_html','acciones'])
            ->make(true);
    }

    public function store(Request $request, ActividadIndicador $actividadIndicador)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'cantidad_disponible' => 'nullable|numeric|min:0',
        ]);

        $exists = ServicioActividad::where('actividad_indicador_id', $actividadIndicador->id)
            ->where('servicio_id', $request->servicio_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Ese servicio ya está asignado a esta actividad.');
        }

        ServicioActividad::create([
            'actividad_indicador_id' => $actividadIndicador->id,
            'servicio_id' => $request->servicio_id,
            'cantidad_disponible' => $request->cantidad_disponible ?? 0,
            'estatus' => true,
        ]);

        return back()->with('success', 'Servicio agregado a la actividad.');
    }

    public function update(Request $request, ServicioActividad $servicioActividad)
    {
        $request->validate([
            'cantidad_disponible' => 'required|numeric|min:0',
        ]);

        $servicioActividad->update([
            'cantidad_disponible' => $request->cantidad_disponible,
        ]);

        return response()->json(['ok' => true]);
    }

    public function toggleEstatus(ServicioActividad $servicioActividad)
    {
        $servicioActividad->estatus = !$servicioActividad->estatus;
        $servicioActividad->save();

        return response()->json(['ok'=>true,'estatus'=>$servicioActividad->estatus]);
    }

    public function destroy(ServicioActividad $servicioActividad)
    {
        $servicioActividad->delete();
        return redirect()->back()->with('success', 'Servicio desvinculado.');
    }
}