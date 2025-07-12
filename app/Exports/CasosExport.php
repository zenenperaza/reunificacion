<?php

namespace App\Exports;

use App\Models\Caso;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithAutoFilter;



class CasosExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize,
    WithEvents,
    WithTitle

{
    protected $start;
    protected $end;
    protected $estadoId;
    protected $estatus;
    protected $search;
    protected $estadoCompletado;
    protected $condicion;
    protected $user;


    public function __construct($start = null, $end = null, $estadoId = null, $estatus = null, $search = null, $estadoCompletado = null, $condicion = null, $user = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->estadoId = $estadoId;
        $this->estatus = $estatus;
        $this->search = $search;
        $this->estadoCompletado = $estadoCompletado;
        $this->condicion = $condicion;
        $this->user = $user;
    }

    public function collection()
    {
        $query = Caso::with([
            'estado',
            'municipio',
            'parroquia',
            'estadoDestino',
            'municipioDestino',
            'parroquiaDestino',
            'user'
        ]);

        if (!$this->user->es_superior && !$this->user->hasRole('Administrador')) {
            if (is_null($this->user->parent_id)) {
                // Es padre: ver sus casos y los de sus hijos
                $ids = \App\Models\User::where('parent_id', $this->user->id)->pluck('id')->toArray();
                $ids[] = $this->user->id;
                $query->whereIn('user_id', $ids);
            } else {
                // Es hijo
                $padreId = $this->user->parent_id;
                $ids = [$this->user->id, $padreId];

                // Ver entre hermanos solo si la familia lo permite
                $familias = $this->user->familias()->wherePivot('rol', 'hijo')->get();
                $puedeVerHermanos = $familias->contains(function ($familia) {
                    return $familia->ver_entre_hermanos;
                });

                if ($puedeVerHermanos) {
                    $hermanos = \App\Models\User::where('parent_id', $padreId)->pluck('id')->toArray();
                    $ids = array_unique(array_merge($ids, $hermanos));
                }

                $query->whereIn('user_id', $ids);
            }
        }


        if ($this->start && $this->end) {
            $query->whereBetween('fecha_actual', [$this->start, $this->end]);
        }

        if ($this->estadoId) {
            $query->where('estado_id', $this->estadoId);
        }

        if ($this->estatus) {
            $query->where('estatus', $this->estatus);
        }

        if ($this->condicion === 'Aprobado') {
            $query->where('condicion', 'Aprobado');
        } elseif ($this->condicion === 'No aprobado') {
            $query->where(function ($q) {
                $q->whereNull('condicion')->orWhere('condicion', '!=', 'Aprobado');
            });
        } elseif ($this->condicion) {
            // Aplica condición exacta (por ejemplo: "En espera")
            $query->where('condicion', $this->condicion);
        }



        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->where('numero_caso', 'like', $searchTerm)
                    ->orWhere('beneficiario', 'like', $searchTerm)
                    ->orWhere('tipo_atencion', 'like', $searchTerm)
                    ->orWhere('elaborado_por', 'like', $searchTerm)
                    ->orWhere('direccion_domicilio', 'like', $searchTerm)
                    ->orWhereRaw("DATE_FORMAT(fecha_actual, '%d/%m/%Y') LIKE ?", [$searchTerm])
                    ->orWhereRaw("fecha_actual LIKE ?", [$searchTerm]); // por si viene en formato YYYY-MM-DD
            });
        }


        // Ejecutar consulta
        $casos = $query->get();

        // Aplicar filtro por estado_completado (opcional)
        if ($this->estadoCompletado) {
            $casos = $casos->filter(function ($caso) {
                $campos = [
                    'numero_caso',
                    'fecha_atencion',
                    'fecha_actual',
                    'tipo_atencion',
                    'beneficiario',
                    'direccion_domicilio',
                    'estatus',
                    'user_id',
                ];

                $faltantes = collect($campos)->filter(fn($campo) => empty($caso->$campo));

                return $this->estadoCompletado === 'completo'
                    ? $faltantes->isEmpty()
                    : $faltantes->isNotEmpty();
            });
        }

        return $casos;
    }


    public function headings(): array
    {
        return [
            'ID',
            'N° Caso',
            'Periodo',
            'Fecha Atención',
            'Fecha Actual',
            'Estado',
            'Municipio',
            'Parroquia',
            'Estado Destino',
            'Municipio Destino',
            'Parroquia Destino',
            'Dirección Domicilio',
            'Número Contacto',
            'Elaborado Por',
            'Tipo Atención',
            'Beneficiario',
            'Edad Beneficiario',
            'Población LGBTI',
            'Representante Legal',
            'País Procedencia',
            'Otro País',
            'Nacionalidad Solicitante',
            'Tipo Documento',
            'País Nacimiento',
            'Otro País Nacimiento',
            'Etnia Indígena',
            'Otra Etnia',
            'Estatus',
            'Descripción',
            'Verificador',
            'Organización Programa',
            'Organización Solicitante',
            'Otras Organizaciones',
            'Tipo Atención Programa',
            'Educación',
            'Nivel Educativo',
            'Tipo Institución',
            'Estado Mujer',
            'Acompañante',
            'Servicio Brindado COSUDE',
            'Servicio Brindado UNICEF',
            'Tipo Actuación',
            'Otro Tipo Actuación',
            'Vulnerabilidades',
            'Derechos Vulnerados',
            'Identificación Violencia',
            'Tipos Violencia Vicaria',
            'Remisiones',
            'Otras Remisiones',
            'Indicadores',
            'Usuario Responsable',
            'Condición',

        ];
    }

    public function map($caso): array
    {
        return [
            $caso->id,
            $caso->numero_caso,
            $caso->periodo,
            Carbon::parse($caso->fecha_atencion)->format('d/m/Y'),
            Carbon::parse($caso->fecha_actual)->format('d/m/Y'),
            $caso->estado->nombre ?? '',
            $caso->municipio->nombre ?? '',
            $caso->parroquia->nombre ?? '',
            $caso->estadoDestino->nombre ?? '',
            $caso->municipioDestino->nombre ?? '',
            $caso->parroquiaDestino->nombre ?? '',
            $caso->direccion_domicilio,
            $caso->numero_contacto,
            $caso->elaborado_por,
            $caso->tipo_atencion,
            $caso->beneficiario,
            $caso->edad_beneficiario,
            $caso->poblacion_lgbti === 'Si' ? 'Si' : 'No',
            $caso->representante_legal,
            $caso->pais_procedencia,
            $caso->otro_pais,
            $caso->nacionalidad_solicitante,
            $caso->tipo_documento,
            $caso->pais_nacimiento,
            $caso->otro_pais_nacimiento,
            $caso->etnia_indigena,
            $caso->otra_etnia,
            $caso->estatus,
            $caso->observaciones,
            $caso->verificador,
            $caso->organizacion_programa,
            $caso->organizacion_solicitante,
            $caso->otras_organizaciones,
            $caso->tipo_atencion_programa,
            $caso->educacion,
            $caso->nivel_educativo,
            $caso->tipo_institucion,
            $caso->estado_mujer,
            $caso->acompanante,
            $caso->servicio_brindado_cosude,
            $caso->servicio_brindado_unicef,
            $caso->tipo_actuacion,
            $caso->otro_tipo_actuacion,
            $this->formatJson($caso->vulnerabilidades),
            $this->formatJson($caso->derechos_vulnerados),
            $this->formatJson($caso->identificacion_violencia),
            $this->formatJson($caso->tipos_violencia_vicaria),
            $this->formatJson($caso->remisiones),
            $caso->otras_remisiones,
            $this->formatJson($caso->indicadores),
            $caso->user->name ?? '',
            $caso->condicion ?? 'Sin especificar',

        ];
    }

    private function formatJson($value)
    {
        if (is_array($value)) return implode(', ', $value);
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) return implode(', ', $decoded);
        }
        return $value;
    }

    public function styles(Worksheet $sheet)
    {
        // Aplicar autofiltro y estilos de encabezado
        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());

        return [
            1 => [ // Fila 1 = encabezados
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFD9D9D9']
                ]
            ]
        ];
    }

    public function title(): string
    {
        if ($this->estatus) {
            return $this->estatus;
        }

        if ($this->estadoId) {
            $estado = \App\Models\Estado::find($this->estadoId);
            return $estado ? $estado->nombre : 'Sin Estado';
        }

        return 'Casos';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Insertar título grande encima del encabezado
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->mergeCells('A1:AZ1');
                $event->sheet->setCellValue('A1', 'Listado de Casos Exportados');
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            }
        ];
    }
}
