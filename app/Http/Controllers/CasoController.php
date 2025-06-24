<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\CasosExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Storage;

class CasoController extends Controller
{
    public function index()
    {
        return view('caso.index');
    }

    public function data(Request $request)
    {
        $query = Caso::with(['estado', 'municipio']);

        // Filtro por rango de fechas
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('fecha_actual', [$request->start_date, $request->end_date]);
        }

        return datatables()->of($query)

            ->addColumn('acciones', function ($caso) {
                $edit = route('casos.edit', $caso->id);
                $delete = route('casos.destroy', $caso->id);
                return '
        <a href="' . $edit . '" class="btn btn-sm btn-primary" title="Editar">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button class="btn btn-sm btn-danger btn-delete" 
            data-url="' . $delete . '" 
            data-nombre="' . $caso->numero_caso . '">
            <i class="mdi mdi-delete"></i>
        </button>
    ';
            })


            ->editColumn('fecha_atencion', function ($caso) {
                return $caso->fecha_atencion ? \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') : '';
            })
            ->editColumn('fecha_actual', function ($caso) {
                return $caso->fecha_actual ? \Carbon\Carbon::parse($caso->fecha_actual)->format('d/m/Y') : '';
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
        // $request->validate([
        //     'numero_caso' => 'required',
        //     'fecha_atencion' => 'required|date',
        //     'estado_id' => 'required|exists:estados,id',
        //     'municipio_id' => 'required|exists:municipios,id',
        //     'parroquia_id' => 'required|exists:parroquias,id',
        //     'estatus' => 'required',
        //     'descripcion' => 'nullable|string',
        //     'fotos.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        //     'archivos.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        // ]);

        // Guardar imágenes
        $fotos = [];
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $imagen) {
                $path = $imagen->store('casos/imagenes', 'public');
                $fotos[] = $path;
            }
        }

        // Guardar documentos
        $archivos = [];
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $path = $archivo->store('casos/documentos', 'public');
                $archivos[] = $path;
            }
        }

        // Crear el caso con campos directos
        $caso = Caso::create([
            'numero_caso' => $request->numero_caso,
            'periodo' => $request->periodo,
            'fecha_atencion' => $request->fecha_atencion,
            'estado_id' => $request->estado_id,
            'municipio_id' => $request->municipio_id,
            'parroquia_id' => $request->parroquia_id,
            'estado_destino_id' => $request->estado_destino_id,
            'municipio_destino_id' => $request->municipio_destino_id,
            'parroquia_destino_id' => $request->parroquia_destino_id,
            'direccion_domicilio' => $request->direccion_domicilio,
            'numero_contacto' => $request->numero_contacto,
            'elaborado_por' => $request->elaborado_por,
            'tipo_atencion' => $request->tipo_atencion,
            'beneficiario' => $request->beneficiario,
            'edad_beneficiario' => $request->edad_beneficiario,
            'poblacion_lgbti' => $request->poblacion_lgbti == 'Si' ? true : false,
            'representante_legal' => $request->representante_legal,
            'pais_procedencia' => $request->pais_procedencia,
            'otro_pais' => $request->otro_pais,
            'nacionalidad_solicitante' => $request->nacionalidad_solicitante,
            'tipo_documento' => $request->tipo_documento,
            'pais_nacimiento' => $request->pais_nacimiento,
            'otro_pais_nacimiento' => $request->otro_pais_nacimientos,
            'etnia_indigena' => $request->etnia_indigena,
            'otra_etnia' => $request->otra_etnia,
            'fecha_actual' => $request->fecha_actual,
            'estatus' => $request->estatus,
            'descripcion' => $request->descripcion,
            'verificador' => $request->verificador,
            'user_id' => auth()->id(),
            'fotos' => json_encode($fotos),
            'archivos' => json_encode($archivos),
        ]);

        // Campos adicionales como string (checkboxes múltiples en array)
        $caso->organizacion_programa = is_array($request->organizacion_programas)
            ? implode(',', $request->organizacion_programas) : $request->organizacion_programas;

        $caso->organizacion_solicitante = is_array($request->organizacion_solicitante)
            ? implode(',', $request->organizacion_solicitante) : $request->organizacion_solicitante;

        $caso->otras_organizaciones = $request->otras_organizaciones;
        $caso->tipo_atencion_programa = is_array($request->tipo_atencion_programa)
            ? implode(',', $request->tipo_atencion_programa) : $request->tipo_atencion_programa;

        $caso->educacion = $request->educacion;
        $caso->nivel_educativo = $request->nivel_educativo;
        $caso->tipo_institucion = $request->tipo_institucion;
        $caso->estado_mujer = is_array($request->estado_mujer) ? implode(',', $request->estado_mujer) : $request->estado_mujer;
        $caso->acompanante = is_array($request->acompanante) ? implode(',', $request->acompanante) : $request->acompanante;
        $caso->servicio_brindado_cosude = is_array($request->servicio_brindado_cosude) ? implode(',', $request->servicio_brindado_cosude) : $request->servicio_brindado_cosude;
        $caso->servicio_brindado_unicef = is_array($request->servicio_brindado_unicef) ? implode(',', $request->servicio_brindado_unicef) : $request->servicio_brindado_unicef;
        $caso->tipo_actuacion = is_array($request->tipo_actuacion) ? implode(',', $request->tipo_actuacion) : $request->tipo_actuacion;
        $caso->otro_tipo_actuacion = $request->otros_actuacion_descripcion;
        $caso->vulnerabilidades = json_encode($request->vulnerabilidades);
        $caso->derechos_vulnerados = json_encode($request->derechos_vulnerados);
        $caso->identificacion_violencia = json_encode($request->identificacion_violencia);
        $caso->tipos_violencia_vicaria = json_encode($request->tipos_violencia_vicaria);
        $caso->remisiones = json_encode($request->remisiones);
        $caso->otras_remisiones = $request->otras_remisiones;
        $caso->indicadores = json_encode($request->indicadores);

        $caso->save();

        return redirect()->route('casos.index')->with('success', 'Caso registrado correctamente.');
    }



    public function edit($id)
    {
        $caso = Caso::findOrFail($id);
        $estados = Estado::all(); // si usas estados en un select

        return view('caso.edit', compact('caso', 'estados'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_caso' => 'required|string|max:255',
            'fecha_atencion' => 'nullable|date',
            'estado_id' => 'nullable|exists:estados,id',
            // agrega validaciones para otros campos
        ]);

        $caso = Caso::findOrFail($id);

        $caso->numero_caso = $request->numero_caso;
        $caso->fecha_atencion = $request->fecha_atencion;
        $caso->estado_id = $request->estado_id;
        // agrega los demás campos

        $caso->save();

        return redirect()->route('casos.index')->with('success', 'Caso actualizado correctamente');
    }


    public function destroy($id)
    {
        $caso = Caso::findOrFail($id);
        $caso->delete();

        return response()->json(['success' => true]);
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



    public function exportarExcel(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        // Formatear el nombre del archivo con la fecha
        $filename = 'casos_' . ($start ?? 'inicio') . '_a_' . ($end ?? 'hoy') . '.xlsx';

        return Excel::download(new CasosExport($start, $end), $filename);
    }




    public function show($id)
    {
        $caso = Caso::with(['estado', 'municipio', 'parroquia'])->findOrFail($id);

        return view('casos.show', compact('caso'));
    }




    // public function upload(Request $request)
    // {
    //     if ($request->hasFile('file')) {
    //         $path = $request->file('file')->store('casos/imagenes', 'public');
    //         return response()->json(['path' => $path], 200);
    //     }

    //     return response()->json(['error' => 'No se subió ningún archivo.'], 400);
    // }

    // public function uploadTemp(Request $request)
    // {
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    //         $file->storeAs('temp_casos', $filename, 'public');

    //         return response()->json(['filename' => $filename]);
    //     }

    //     return response()->json(['error' => 'No file uploaded'], 400);
    // }
}
