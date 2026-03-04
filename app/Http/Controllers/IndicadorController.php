<?php

namespace App\Http\Controllers;

use App\Models\Indicador;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IndicadorController extends Controller
{
    public function index()
    {
        return view('indicadores.index');
    }

    public function data(Request $request)
    {
        $query = Indicador::query()->select('indicadores.*');      

        return DataTables::of($query)

            ->addColumn('acciones', function ($i) {

                $puedeVer      = auth()->user()->can('ver indicadores');
                $puedeEditar   = auth()->user()->can('editar indicadores');
                $puedeEliminar = auth()->user()->can('eliminar indicadores');

                if (!$puedeVer && !$puedeEditar && !$puedeEliminar) {
                    return '-';
                }

                $botones = '<div class="acciones-btns d-flex justify-content-center gap-1">';

                if ($puedeVer) {
                    $botones .= '<a href="'.route('indicadores.show',$i->id).'" class="btn btn-sm btn-primary" title="Ver">
                                    <i class="mdi mdi-eye"></i>
                                 </a>';
                }

                if ($puedeEditar) {
                    $botones .= '<a href="'.route('indicadores.edit',$i->id).'" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                 </a>';
                }

                if ($puedeEliminar) {
                    $botones .= '<button class="btn btn-sm btn-danger btn-delete"
                                    title="Eliminar"
                                    data-url="'.route('indicadores.destroy',$i->id).'"
                                    data-nombre="'.e($i->codigo).'">
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
        return view('indicadores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo'      => 'required|string|max:50|unique:indicadores,codigo',
            'descripcion' => 'required|string|max:255',
        ]);


        Indicador::create($data);

        return redirect()->route('indicadores.index')
            ->with('success', 'Indicador creado correctamente.');
    }

    public function show(Indicador $indicador)
    {
        return view('indicadores.show', compact('indicador'));
    }

    public function edit(Indicador $indicador)
    {
        return view('indicadores.edit', compact('indicador'));
    }

    public function update(Request $request, Indicador $indicador)
    {
        $data = $request->validate([
            'codigo'      => 'required|string|max:50|unique:indicadores,codigo,'.$indicador->id,
            'descripcion' => 'required|string|max:255',

        ]);
    

        $indicador->update($data);

        return redirect()->route('indicadores.index')
            ->with('success', 'Indicador actualizado correctamente.');
    }

    public function destroy(Indicador $indicador)
    {
        try {
            $indicador->delete();
            return redirect()->route('indicadores.index')
                ->with('success', 'Indicador eliminado correctamente.');
        } catch (\Throwable $e) {
            return redirect()->route('indicadores.index')
                ->with('error', 'No se pudo eliminar el indicador.');
        }
    }

 
}