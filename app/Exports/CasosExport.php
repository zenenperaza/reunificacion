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

    public function __construct($start = null, $end = null, $estadoId = null, $estatus = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->estadoId = $estadoId;
        $this->estatus = $estatus;
    }

    public function collection()
    {
        $query = Caso::with(['estado', 'municipio', 'parroquia', 'estadoDestino', 'municipioDestino', 'parroquiaDestino', 'user']);

        if ($this->start && $this->end) {
            $query->whereBetween('fecha_actual', [$this->start, $this->end]);
        }
        if ($this->estadoId) {
            $query->where('estado_id', $this->estadoId);
        }

        if ($this->estatus) {
            $query->where('estatus', $this->estatus);
        }


        return $query->get();
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
            'Usuario Responsable'
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
            $caso->descripcion,
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
