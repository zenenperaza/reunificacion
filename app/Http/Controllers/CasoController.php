<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\CasosExport;
use App\Exports\CasosPorEstadoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CasosPorEstatusExport;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CasosPlantillaExport;
use App\Imports\CasosImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



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

        // ✅ Filtro por estatus
        if ($request->filled('estatus')) {
            $query->where('estatus', $request->estatus);
        }

        return datatables()->of($query)
            ->addColumn('acciones', function ($caso) {
                $botones = '<div class="btn-group" role="group">';

                if (auth()->user()->can('ver casos')) {
                    $botones .= '
            <a href="' . route('casos.show', $caso->id) . '" class="btn btn-sm btn-outline-primary" title="Ver">
                <i class="mdi mdi-eye"></i>
            </a>';
                }

                if (auth()->user()->can('editar casos')) {
                    $botones .= '
            <a href="' . route('casos.edit', $caso->id) . '" class="btn btn-sm btn-outline-warning" title="Editar">
                <i class="mdi mdi-pencil"></i>
            </a>';
                }

                // Clonar no tiene permiso aún, opcional:
                $botones .= '
        <a href="#" class="btn btn-sm btn-outline-success" title="Clonar">
            <i class="mdi mdi-account-multiple-plus-outline"></i>
        </a>';

                if (auth()->user()->can('eliminar casos')) {
                    $botones .= '
            <button class="btn btn-sm btn-outline-danger btn-delete"
                data-url="' . route('casos.destroy', $caso->id) . '"
                data-nombre="' . e($caso->numero_caso) . '">
                <i class="mdi mdi-trash-can-outline"></i>
            </button>';
                }

                $botones .= '</div>';

                return $botones;
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
        //     'observaciones' => 'nullable|string',
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
            'poblacion_lgbti' => $request->poblacion_lgbti,
            'representante_legal' => $request->representante_legal,
            'pais_procedencia' => $request->pais_procedencia,
            'otro_pais' => $request->otro_pais,
            'nacionalidad_solicitante' => $request->nacionalidad_solicitante,
            'tipo_documento' => $request->tipo_documento,
            'pais_nacimiento' => $request->pais_nacimiento,
            'otro_pais_nacimiento' => $request->otro_pais_nacimientos,
            'etnia_indigena' => $request->etnia_indigena,
            'otra_etnia' => $request->otra_etnia,
            'discapacidad' => $request->discapacidad,
            'fecha_actual' => $request->fecha_actual,
            'estatus' => $request->estatus,
            'observaciones' => $request->observaciones,
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

        if (
            $request->tipo_atencion === 'Grupo familiar' &&
            $request->has('clonar_integrantes') &&
            $request->numero_integrantes > 0
        ) {
            for ($i = 0; $i < $request->numero_integrantes; $i++) {
                $nuevo = $caso->replicate();
                $nuevo->tipo_atencion = 'Individual'; // cambiar tipo de atención
                $nuevo->save();
            }
        }
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
        $caso = Caso::findOrFail($id);

        // Recuperar archivos ya existentes
        $fotosAnteriores = json_decode($caso->fotos ?? '[]', true);
        $archivosAnteriores = json_decode($caso->archivos ?? '[]', true);

        // Guardar nuevas fotos
        $nuevasFotos = [];
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('fotos', 'public');
                $nuevasFotos[] = $path;
            }
        }

        // Guardar nuevos documentos
        $nuevosArchivos = [];
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $path = $archivo->store('archivos', 'public');
                $nuevosArchivos[] = $path;
            }
        }

        // Combinar los archivos viejos con los nuevos
        $caso->fotos = json_encode(array_merge($fotosAnteriores, $nuevasFotos));
        $caso->archivos = json_encode(array_merge($archivosAnteriores, $nuevosArchivos));

        // Resto de campos
        $caso->fill([
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
            'numero_caso' => $request->numero_caso,
            'tipo_atencion' => $request->tipo_atencion,
            'beneficiario' => $request->beneficiario,
            'edad_beneficiario' => $request->edad_beneficiario,
            'poblacion_lgbti' => $request->poblacion_lgbti,
            'educacion' => $request->educacion,
            'nivel_educativo' => $request->nivel_educativo,
            'tipo_institucion' => $request->tipo_institucion,
            'estado_mujer' => implode(',', $request->estado_mujer ?? []),
            'acompanante' => implode(',', $request->acompanante ?? []),
            'representante_legal' => $request->representante_legal,
            'pais_procedencia' => $request->pais_procedencia,
            'otro_pais' => $request->otro_pais,
            'nacionalidad_solicitante' => $request->nacionalidad_solicitante,
            'tipo_documento' => $request->tipo_documento,
            'pais_nacimiento' => $request->pais_nacimiento,
            'otro_pais_nacimientos' => $request->otro_pais_nacimientos,
            'etnia_indigena' => $request->etnia_indigena,
            'otra_etnia' => $request->otra_etnia,
            'discapacidad' => $request->discapacidad,
            'organizacion_programa' => implode(',', $request->organizacion_programa ?? []),
            'organizacion_solicitante' => implode(',', $request->organizacion_solicitante ?? []),
            'otras_organizaciones' => $request->otras_organizaciones,
            'tipo_atencion_programa' => implode(',', $request->tipo_atencion_programa ?? []),
            'servicio_brindado_cosude' => implode(',', $request->servicio_brindado_cosude ?? []),
            'servicio_brindado_unicef' => implode(',', $request->servicio_brindado_unicef ?? []),
            'tipo_actuacion' => implode(',', $request->tipo_actuacion ?? []),
            'otros_actuacion_descripcion' => $request->otros_actuacion_descripcion,
            'vulnerabilidades' => json_encode($request->vulnerabilidades ?? []),
            'derechos_vulnerados' => json_encode($request->derechos_vulnerados ?? []),
            'identificacion_violencia' => json_encode($request->identificacion_violencia ?? []),
            'tipos_violencia_vicaria' => json_encode($request->tipos_violencia_vicaria ?? []),
            'remisiones' => json_encode($request->remisiones ?? []),
            'otras_remisiones' => $request->otras_remisiones,
            'fecha_actual' => $request->fecha_actual,
            'estatus' => $request->estatus,
            'indicadores' => json_encode($request->indicadores ?? []),
            'observaciones' => $request->observaciones,
            'verificador' => $request->verificador,
        ]);

        $caso->save();

        return redirect()->route('casos.index')->with('success', 'Caso actualizado correctamente.');
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
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $estatus = $request->input('estatus');

        $filename = 'casos_' . ($start ?? 'inicio') . '_a_' . ($end ?? 'hoy') . '.xlsx';

        return Excel::download(new CasosExport($start, $end, null, $estatus), $filename);
    }



    public function exportarPorEstado(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        return Excel::download(new CasosPorEstadoExport($start, $end), 'casos_por_estado.xlsx');
    }


    public function exportarPorEstatus(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        return Excel::download(
            new CasosPorEstatusExport($start, $end),
            'casos_por_estatus.xlsx'
        );
    }


    public function show($id)
    {
        $caso = Caso::with(['estado', 'municipio', 'parroquia', 'user'])->findOrFail($id);
        return view('caso.show', compact('caso'));
    }



    public function eliminarArchivo(Request $request, $id)
    {
        $caso = Caso::findOrFail($id);

        $tipo = $request->input('tipo'); // 'foto' o 'archivo'
        $archivo = $request->input('archivo');

        if (!$tipo || !$archivo) {
            return response()->json(['success' => false, 'message' => 'Datos incompletos']);
        }

        $campo = $tipo === 'foto' ? 'fotos' : 'archivos';

        $archivos = json_decode($caso->$campo, true) ?? [];

        // Verifica si el archivo está en la lista
        if (!in_array($archivo, $archivos)) {
            return response()->json(['success' => false, 'message' => 'Archivo no encontrado']);
        }

        // Elimina físicamente el archivo si existe
        if (Storage::disk('public')->exists($archivo)) {
            Storage::disk('public')->delete($archivo);
        }

        // Elimina del array y guarda nuevamente
        $archivos = array_values(array_filter($archivos, function ($item) use ($archivo) {
            return $item !== $archivo;
        }));

        $caso->$campo = json_encode($archivos);
        $caso->save();

        return response()->json(['success' => true]);
    }



    public function exportarPDF($id)
    {
        $caso = Caso::with(['estado', 'municipio', 'parroquia', 'estadoDestino', 'municipioDestino', 'parroquiaDestino', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('caso.pdf', compact('caso'));
        return $pdf->download('caso_' . $caso->numero_caso . '.pdf');
    }

    public function importarExcel(Request $request)
    {
        Excel::import(new CasosImport, $request->file('archivo_excel'));

        $importados = session('importados', 0);
        $errores = session('errores_importacion', []);

        if ($importados > 0) {
            return back()->with('success', "$importados casos importados correctamente.")
                ->with('errores_importacion', $errores);
        } else {
            return back()->with('error', 'No se importaron casos. Verifica el archivo.')
                ->with('errores_importacion', $errores);
        }
    }




    public function descargarPlantilla()
    {
        return Excel::download(new CasosPlantillaExport, 'plantilla_casos.xlsx');
    }


    public function importarVista()
    {
        return view('caso.importar');
    }

    public function previsualizarExcel(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        $filename = Str::random(20) . '.xlsx';

        // Guardar en disco 'local' (ya configurado con storage_path('app/private'))
        $path = $request->file('archivo_excel')->storeAs('temp', $filename, 'local');

        // Ruta absoluta correcta
        $rutaAbsoluta = Storage::disk('local')->path($path);

        // Leer datos
        $data = Excel::toArray([], $rutaAbsoluta);
        $rows = $data[0];

        // Guardar solo la ruta relativa para luego ubicarla con disk('local')
        session(['archivo_excel_temporal' => $path]);

        return response()->json([
            'columns' => $rows[0] ?? [],
            'rows' => array_slice($rows, 1),
        ]);
    }

    public function confirmarImportacion()
    {
        $path = session('archivo_excel_temporal');

        if (!$path || !Storage::disk('local')->exists($path)) {
            return back()->with('error', 'No se encontró el archivo a importar.');
        }

        $rutaAbsoluta = Storage::disk('local')->path($path);

        Excel::import(new \App\Imports\CasosImport, $rutaAbsoluta);

        Storage::disk('local')->delete($path);
        session()->forget('archivo_excel_temporal');

        return redirect()->route('casos.index')->with('success', 'Casos importados correctamente.');
    }

    public function descargarArchivos($id)
    {
        $caso = Caso::findOrFail($id);
        $zip = new \ZipArchive();
        $filename = storage_path("app/public/caso_{$caso->id}_archivos.zip");

        if ($zip->open($filename, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            $fotos = json_decode($caso->fotos, true) ?? [];
            $archivos = json_decode($caso->archivos, true) ?? [];

            foreach (array_merge($fotos, $archivos) as $file) {
                $path = storage_path("app/public/" . $file);
                if (file_exists($path)) {
                    $zip->addFile($path, basename($path));
                }
            }

            $zip->close();
            return response()->download($filename)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'No se pudo generar el archivo ZIP.');
    }

    public function cerrar(Caso $caso)
    {
        $caso->estatus = 'Cierre de atención';
        $caso->save();
        return response()->json(['success' => true]);
    }

    public function eliminados()
    {
        return view('caso.eliminados');
    }


    public function dataEliminados()
    {
        $query = Caso::onlyTrashed();
        return datatables()->of($query)
            ->addColumn('acciones', function ($caso) {
                if (auth()->user()->can('restaurar casos eliminados')) {
                    return '<button class="btn btn-sm btn-success btn-restore" data-id="' . $caso->id . '">Restaurar</button>';
                }
                return '';
            })
            ->rawColumns(['acciones'])
            ->make(true);
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
