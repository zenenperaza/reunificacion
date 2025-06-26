<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;

class CasosPlantillaExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        // Se retorna una fila vacía con los mismos campos que la exportación
        return new Collection([
            [
                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                '', '', '', '', '', '', '', '', '', '', '', '', ''
            ]
        ]);
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

    public function title(): string
    {
        return 'Plantilla Casos';
    }
}
