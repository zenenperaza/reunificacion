<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Donante;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;


class ProyectoController extends Controller
{
    public function index()
    {
        return view('proyectos.index');
    }



    public function data(Request $request)
    {
        $query = Proyecto::query()
            ->with([
                'donante:id,nombre',
                'estados:id,nombre',
                'municipios:id,nombre,estado_id',
            ])
            ->select('proyectos.*');

        if ($request->filled('estatus') && $request->estatus !== 'all') {
            $query->where('estatus', (bool) $request->estatus);
        }

        return DataTables::of($query)

            ->addColumn('donante_nombre', fn($p) => $p->donante?->nombre ?? '-')

            ->addColumn(
                'inicio_fmt',
                fn($p) =>
                $p->inicio ? Carbon::parse($p->inicio)->format('d/m/Y') : '-'
            )

            ->addColumn(
                'fin_fmt',
                fn($p) =>
                $p->fin ? Carbon::parse($p->fin)->format('d/m/Y') : '-'
            )

            // ✅ NUEVO: estados
            ->addColumn('estados_info', function ($p) {
                if ($p->estados->isEmpty()) return '-';

                $nombres = $p->estados->pluck('nombre')->unique()->take(3)->values();
                $extra = $p->estados->pluck('nombre')->unique()->count() - $nombres->count();

                $html = $nombres->map(fn($e) => '<span class="badge bg-secondary me-1">' . $e . '</span>')->implode('');
                if ($extra > 0) $html .= '<span class="badge bg-dark">+' . $extra . '</span>';

                return $html;
            })

            // ✅ NUEVO: municipios
            ->addColumn('municipios_info', function ($p) {
                if ($p->municipios->isEmpty()) return '-';

                $nombres = $p->municipios->pluck('nombre')->unique()->take(3)->values();
                $extra = $p->municipios->pluck('nombre')->unique()->count() - $nombres->count();

                $html = $nombres->map(fn($m) => '<span class="badge bg-info me-1">' . $m . '</span>')->implode('');
                if ($extra > 0) $html .= '<span class="badge bg-dark">+' . $extra . '</span>';

                return $html;
            })

            ->addColumn('estatus_html', function ($p) {
                $checked = $p->estatus ? 'checked' : '';
                $label = $p->estatus ? 'Activo' : 'Inactivo';

                return '
                <input type="checkbox"
                    class="switch-proyecto"
                    data-id="' . $p->id . '"
                    ' . $checked . ' />
                <span class="ms-2 switch-label ' . ($p->estatus ? 'text-success' : 'text-danger') . '">
                    ' . $label . '
                </span>
            ';
            })

            ->addColumn('acciones', function ($p) {

                $botones = '<div class="d-flex justify-content-center gap-1">';

                if (auth()->user()->can('ver proyectos')) {
                    $botones .= '<a href="' . route('proyectos.show', $p->id) . '" class="btn btn-sm btn-primary" title="Ver">
                                <i class="mdi mdi-eye"></i>
                            </a>';
                }

                if (auth()->user()->can('editar proyectos')) {
                    $botones .= '<a href="' . route('proyectos.edit', $p->id) . '" class="btn btn-sm btn-warning" title="Editar">
                                <i class="mdi mdi-pencil"></i>
                            </a>';
                }

                if (auth()->user()->can('eliminar proyectos')) {
                    $botones .= '<button class="btn btn-sm btn-danger btn-delete"
                                title="Eliminar"
                                data-url="' . route('proyectos.destroy', $p->id) . '"
                                data-nombre="Proyecto ' . $p->codigo . '">
                                <i class="mdi mdi-trash-can-outline"></i>
                            </button>';
                }

                $botones .= '</div>';

                return $botones;
            })

            ->rawColumns(['estados_info', 'municipios_info', 'estatus_html', 'acciones'])
            ->make(true);
    }


    public function create()
    {
        $donantes = Donante::where('estatus', true)->orderBy('nombre')->get(['id', 'nombre']);
        $estados  = \App\Models\Estado::orderBy('nombre')->get(['id', 'nombre']);

        return view('proyectos.create', compact('donantes', 'estados'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'donante_id'   => 'required|exists:donantes,id',
            'codigo'       => 'nullable|numeric',
            'descripcion'  => 'required|string|max:255',
            'inicio'       => 'nullable|date',
            'fin'          => 'nullable|date|after_or_equal:inicio',

            // pivotes
            'estados'      => 'nullable|array',
            'estados.*'    => 'integer|exists:estados,id',

            'municipios'   => 'nullable|array',
            'municipios.*' => 'integer|exists:municipios,id',
        ]);

        DB::transaction(function () use ($request) {

            // checkbox: si no viene en el request => false
            $estatus = $request->has('estatus');

            // 1) Crear proyecto
            $proyecto = Proyecto::create([
                'donante_id'  => $request->donante_id,
                'estatus'     => $estatus,
                'codigo'      => $request->codigo,
                'descripcion' => $request->descripcion,
                'inicio'      => $request->inicio,
                'fin'         => $request->fin,
            ]);

            // 2) Sync estados
            $estadoIds = $request->input('estados', []);
            $proyecto->estados()->sync($estadoIds);

            // 3) Sync municipios PERO solo los que pertenezcan a los estados seleccionados
            $municipiosReq = $request->input('municipios', []);

            $municipioIds = Municipio::query()
                ->whereIn('id', $municipiosReq)
                ->when(!empty($estadoIds), fn($q) => $q->whereIn('estado_id', $estadoIds))
                ->pluck('id')
                ->toArray();

            $proyecto->municipios()->sync($municipioIds);
        });

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto creado correctamente');
    }

    public function show(Proyecto $proyecto)
    {
        $proyecto->load([
            'donante:id,nombre',
            'estados:id,nombre',
            'municipios:id,nombre,estado_id',
        ]);

        // Agrupar municipios por estado para mostrar ordenado
        $municipiosPorEstado = $proyecto->municipios
            ->groupBy('estado_id');

        return view('proyectos.show', compact('proyecto', 'municipiosPorEstado'));
    }


    public function edit(Proyecto $proyecto)
    {
        $proyecto->load(['estados:id', 'municipios:id,estado_id']);

        $donantes = \App\Models\Donante::orderBy('nombre')->get(['id', 'nombre']);
        $estados  = \App\Models\Estado::orderBy('nombre')->get(['id', 'nombre']);

        // Precargar municipios de los estados ya seleccionados (para que el select no llegue vacío)
        $estadoIds = $proyecto->estados->pluck('id');
        $municipios = \App\Models\Municipio::whereIn('estado_id', $estadoIds)
            ->orderBy('nombre')
            ->get(['id', 'nombre', 'estado_id']);

        return view('proyectos.edit', compact('proyecto', 'donantes', 'estados', 'municipios'));
    }


    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'donante_id' => 'required|exists:donantes,id',
            'codigo'     => 'required',
            'descripcion' => 'required|string',
            'inicio'     => 'required|date',
            'fin'        => 'required|date|after_or_equal:inicio',

            'estados'    => 'nullable|array',
            'estados.*'  => 'exists:estados,id',

            'municipios'   => 'nullable|array',
            'municipios.*' => 'exists:municipios,id',
        ]);

        // Checkbox (si no viene, es false)
        $estatus = $request->boolean('estatus');

        // 1️⃣ Actualizar datos del proyecto
        $proyecto->update([
            'donante_id'  => $request->donante_id,
            'codigo'      => $request->codigo,
            'descripcion' => $request->descripcion,
            'inicio'      => $request->inicio,
            'fin'         => $request->fin,
            'estatus'     => $estatus,
        ]);

        // 2️⃣ Sync estados
        $estadoIds = $request->input('estados', []);
        $proyecto->estados()->sync($estadoIds);

        // 3️⃣ 🔒 Filtrar municipios para que solo pertenezcan a los estados seleccionados
        $municipioIds = \App\Models\Municipio::whereIn('id', $request->input('municipios', []))
            ->whereIn('estado_id', $estadoIds)
            ->pluck('id')
            ->toArray();

        $proyecto->municipios()->sync($municipioIds);

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto actualizado correctamente');
    }

    
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto eliminado satisfactoriamente');
    }


    public function cambiarEstatus(Proyecto $proyecto)
    {
        $proyecto->estatus = !$proyecto->estatus;
        $proyecto->save();

        return response()->json(['ok' => true]);
    }

    public function municipiosPorEstados(Request $request)
    {
        $estadoIds = $request->input('estados', []);

        return \App\Models\Municipio::whereIn('estado_id', $estadoIds)
            ->orderBy('nombre')
            ->get(['id', 'nombre']);
    }
}
