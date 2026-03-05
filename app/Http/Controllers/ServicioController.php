<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{
    public function index()
    {
        return view('servicios.index');
    }

    public function data(Request $request)
    {
        $query = Servicio::query()->select('servicios.*');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qq) use ($q) {
                $qq->where('nombre', 'like', "%{$q}%")
                   ->orWhere('descripcion', 'like', "%{$q}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('acciones', function ($s) {

                $puedeVer = auth()->user()->can('ver servicios');
                $puedeEditar = auth()->user()->can('editar servicios');
                $puedeEliminar = auth()->user()->can('eliminar servicios');

                if (!$puedeVer && !$puedeEditar && !$puedeEliminar) {
                    return '-';
                }

                $botones = '<div class="acciones-btns d-flex justify-content-center gap-1">';

                if ($puedeVer) {
                    $botones .= '<a href="' . route('servicios.show', $s->id) . '" class="btn btn-sm btn-primary" title="Ver">
                                    <i class="mdi mdi-eye"></i>
                                 </a>';
                }

                if ($puedeEditar) {
                    $botones .= '<a href="' . route('servicios.edit', $s->id) . '" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                 </a>';
                }

                if ($puedeEliminar) {
                    $botones .= '<button class="btn btn-sm btn-danger btn-delete" title="Eliminar"
                                    data-url="' . route('servicios.destroy', $s->id) . '"
                                    data-nombre="' . e($s->nombre) . '">
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
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:servicios,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        Servicio::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => [
                'required', 'string', 'max:255',
                Rule::unique('servicios', 'nombre')->ignore($servicio->id),
            ],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        $servicio->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        try {
            $servicio->delete();
            return redirect()->route('servicios.index')
                ->with('success', 'Servicio eliminado correctamente.');
        } catch (\Throwable $e) {
            return redirect()->route('servicios.index')
                ->with('error', 'No se pudo eliminar el servicio. Puede estar relacionado a actividades.');
        }
    }
}