<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Indicador;
use App\Models\IndicadorProyecto;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProyectoIndicadorController extends Controller
{
    public function index(Proyecto $proyecto)
    {
        $indicadores = Indicador::orderBy('codigo')->get(['id', 'codigo', 'descripcion']);
        return view('proyectos.indicadores.index', compact('proyecto', 'indicadores'));
    }

    public function data(Proyecto $proyecto)
    {
        $query = IndicadorProyecto::with('indicador:id,codigo,descripcion')
            ->where('proyecto_id', $proyecto->id);

        return DataTables::of($query)
            ->addColumn('codigo', fn($ip) => $ip->indicador?->codigo ?? '-')
            ->addColumn('descripcion', fn($ip) => $ip->indicador?->descripcion ?? '-')
            ->addColumn('estatus_html', function ($ip) {
                $checked = $ip->estatus ? 'checked' : '';
                $label = $ip->estatus ? 'Activo' : 'Inactivo';

                return '
        <input type="checkbox" class="switch-ip" data-id="' . $ip->id . '" ' . $checked . ' />
        <span class="ms-2 switch-label ' . ($ip->estatus ? 'text-success' : 'text-danger') . '">' . $label . '</span>
    ';
            })
            ->addColumn('acciones', function ($ip) {
                $btn = '<div class="d-flex justify-content-center gap-1">';

                // Ir a Actividades del indicador dentro del proyecto
                $btn .= '<a href="' . route('indicadorproyecto.actividades.index', $ip->id) . '"
                            class="btn btn-sm btn-primary" title="Actividades">
                            <i class="mdi mdi-format-list-bulleted"></i>
                         </a>';

                // Editar metas (modal)
                $btn .= '<button class="btn btn-sm btn-warning btn-edit"
                            data-id="' . $ip->id . '"
                            data-meta_cuantitativa="' . $ip->meta_cuantitativa . '"
                            data-meta_cualitativa="' . e($ip->meta_cualitativa) . '"
                            title="Editar metas">
                            <i class="mdi mdi-pencil"></i>
                         </button>';

                // Quitar vínculo
                $btn .= '<button class="btn btn-sm btn-danger btn-delete"
                            data-url="' . route('proyectos.indicadores.destroy', $ip->id) . '"
                            data-nombre="Indicador ' . $ip->indicador?->codigo . '"
                            title="Quitar">
                            <i class="mdi mdi-trash-can-outline"></i>
                         </button>';

                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['estatus_html', 'acciones'])
            ->make(true);
    }

    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'indicador_id' => 'required|exists:indicadores,id',
            'meta_cuantitativa' => 'nullable|numeric|min:0',
            'meta_cualitativa' => 'nullable|string|max:255',
        ]);

        // Evitar duplicado indicador + proyecto
        $exists = IndicadorProyecto::where('proyecto_id', $proyecto->id)
            ->where('indicador_id', $request->indicador_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Ese indicador ya está asignado al proyecto.');
        }

        IndicadorProyecto::create([
            'proyecto_id' => $proyecto->id,
            'indicador_id' => $request->indicador_id,
            'estatus' => true,
            'meta_cuantitativa' => $request->meta_cuantitativa,
            'meta_cualitativa' => $request->meta_cualitativa,
        ]);

        return back()->with('success', 'Indicador agregado al proyecto.');
    }

    public function update(Request $request, IndicadorProyecto $indicadorProyecto)
    {
        $request->validate([
            'meta_cuantitativa' => 'nullable|numeric|min:0',
            'meta_cualitativa' => 'nullable|string|max:255',
        ]);

        $indicadorProyecto->update([
            'meta_cuantitativa' => $request->meta_cuantitativa,
            'meta_cualitativa' => $request->meta_cualitativa,
        ]);

        return response()->json(['ok' => true]);
    }

    public function toggleEstatus(IndicadorProyecto $indicadorProyecto)
    {
        $indicadorProyecto->estatus = !$indicadorProyecto->estatus;
        $indicadorProyecto->save();

        return response()->json(['ok' => true, 'estatus' => $indicadorProyecto->estatus]);
    }

    public function destroy(IndicadorProyecto $indicadorProyecto)
    {
        $indicadorProyecto->delete();
        return redirect()->back()->with('success', 'Indicador desvinculado.');
    }
}
