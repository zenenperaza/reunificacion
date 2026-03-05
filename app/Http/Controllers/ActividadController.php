<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class ActividadController extends Controller
{
    public function index()
    {
        return view('actividades.index');
    }

    public function data(Request $request)
    {
        $query = Actividad::query()->select('actividades.*');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('codigo', 'like', "%{$q}%")
                    ->orWhere('descripcion', 'like', "%{$q}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('acciones', function ($a) {

                $puedeVer = auth()->user()->can('ver actividades');
                $puedeEditar = auth()->user()->can('editar actividades');
                $puedeEliminar = auth()->user()->can('eliminar actividades');

                if (!$puedeVer && !$puedeEditar && !$puedeEliminar) {
                    return '-';
                }

                $botones = '<div class="acciones-btns d-flex justify-content-center gap-1">';

                if ($puedeVer) {
                    $botones .= '<a href="' . route('actividades.show', $a->id) . '" class="btn btn-sm btn-primary" title="Ver">
                                    <i class="mdi mdi-eye"></i>
                                 </a>';
                }

                if ($puedeEditar) {
                    $botones .= '<a href="' . route('actividades.edit', $a->id) . '" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                 </a>';
                }

                if ($puedeEliminar) {
                    $botones .= '<button class="btn btn-sm btn-danger btn-delete" title="Eliminar"
                                    data-url="' . route('actividades.destroy', $a->id) . '"
                                    data-nombre="' . e($a->codigo) . '">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                 </button>';
                }

                $botones .= '</div>';
                return $botones;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function create()
    {
        return view('actividades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => ['required', 'string', 'max:50', 'unique:actividades,codigo'],
            'descripcion' => ['required', 'string', 'max:255'],
        ]);

        Actividad::create([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad creada correctamente.');
    }

    public function show(Actividad $actividad)
    {
        return view('actividades.show', compact('actividad'));
    }

    public function edit(Actividad $actividad)
    {
        return view('actividades.edit', compact('actividad'));
    }

    public function update(Request $request, Actividad $actividad)
    {
        $request->validate([
            'codigo' => [
                'required', 'string', 'max:50',
                Rule::unique('actividades', 'codigo')->ignore($actividad->id),
            ],
            'descripcion' => ['required', 'string', 'max:255'],
        ]);

        $actividad->update([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Actividad $actividad)
    {
        try {
            $actividad->delete();

            return redirect()->route('actividades.index')
                ->with('success', 'Actividad eliminada correctamente.');
        } catch (\Throwable $e) {
            return redirect()->route('actividades.index')
                ->with('error', 'No se pudo eliminar la actividad.');
        }
    }
}