<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\User;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    public function index()
    {
        return view('caso.index');
    }

    public function data()
    {
        return datatables()->of(Caso::with(['estado', 'municipio']))
            ->addColumn('acciones', function ($caso) {
                $edit = route('casos.edit', $caso->id);
                $delete = route('casos.destroy', $caso->id);
                return '
                    <a href="' . $edit . '" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></a>
                    <form action="' . $delete . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'¿Eliminar este caso?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></button>
                    </form>';
            })
            ->editColumn('fecha_atencion', function ($caso) {
                return $caso->fecha_atencion ? \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') : '';
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }


    public function create()
    {
        $estados = Estado::all();
        $organizaciones = ['HIAS', 'ACNUR', 'Save the Children', 'IRC', 'Cruz Roja'];
        $tiposAtencion = ['Reunificación Familiar', 'Atención Psicosocial', 'Gestión de Casos'];
        $cosude = ['KIT DE HIGIENE PERSONAL', 'TRASLADO(NNA)', 'ATENCIÓN PSICOLÓGICA'];
        $unicef = ['ALIMENTOS', 'ALBERGUE', 'ATENCIÓN MÉDICA'];
        $vulnerabilidades = ['NNA No Acompañado', 'Víctima de Violencia', 'Situación de Calle'];
        $derechos = ['Artículo 26 Derecho a ser criado en una familia', 'Artículo 9 Derecho a vivir con sus padres'];

        return view('caso.create', compact(
            'estados',
            'organizaciones',
            'tiposAtencion',
            'cosude',
            'unicef',
            'vulnerabilidades',
            'derechos'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'numero_caso' => 'required|unique:casos',
            'fecha_atencion' => 'required|date',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            // Agrega más validaciones según tu necesidad
        ]);

        $data = $request->all();
        $data['vulnerabilidades'] = json_encode($request->vulnerabilidades);
        $data['derechos_vulnerados'] = json_encode($request->derechos_vulnerados);
        $data['identificacion_violencia'] = json_encode($request->identificacion_violencia);
        $data['tipos_violencia_vicaria'] = json_encode($request->tipos_violencia_vicaria);
        $data['remisiones'] = json_encode($request->remisiones);
        $data['fotos'] = json_encode([]);
        $data['archivos'] = json_encode([]);

        Caso::create($data);

        return redirect()->route('casos.index')->with('success', 'Caso creado correctamente.');
    }

    public function edit(Caso $caso)
    {
        return view('caso.edit', [
            'caso' => $caso,
            'estados' => Estado::all(),
            'municipios' => Municipio::all(),
            'parroquias' => Parroquia::all(),
            'usuarios' => User::all(),
        ]);
    }

    public function update(Request $request, Caso $caso)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'numero_caso' => 'required|unique:casos,numero_caso,' . $caso->id,
            'fecha_atencion' => 'required|date',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
        ]);

        $data = $request->all();
        $data['vulnerabilidades'] = json_encode($request->vulnerabilidades);
        $data['derechos_vulnerados'] = json_encode($request->derechos_vulnerados);
        $data['identificacion_violencia'] = json_encode($request->identificacion_violencia);
        $data['tipos_violencia_vicaria'] = json_encode($request->tipos_violencia_vicaria);
        $data['remisiones'] = json_encode($request->remisiones);

        $caso->update($data);

        return redirect()->route('casos.index')->with('success', 'Caso actualizado correctamente.');
    }

    public function destroy(Caso $caso)
    {
        $caso->delete();
        return redirect()->route('casos.index')->with('success', 'Caso eliminado correctamente.');
    }

    public function getMunicipios($estado_id)
    {
        $municipios = Municipio::where('estado_id', $estado_id)->get();
        return response()->json($municipios);
    }

    public function getParroquias($municipio_id)
    {
        $parroquias = Parroquia::where('municipio_id', $municipio_id)->get();
        return response()->json($parroquias);
    }


public function contadorPorEstado($estadoId)
{
    $estado = Estado::findOrFail($estadoId);
    $conteo = Caso::where('estado_id', $estadoId)->count();

    return response()->json([
        'estado_nombre' => $estado->nombre,
        'conteo' => $conteo,
    ]);
}

}
