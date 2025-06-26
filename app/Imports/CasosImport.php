<?php

namespace App\Imports;

use App\Models\Caso;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CasosImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $this->importados = 0;
        $this->errores = [];

        foreach ($rows as $index => $row) {
            // Saltar la primera fila si es encabezado (opcional)
            if ($index < 2) continue;
            if ($index === 0) continue;

            try {
                $estadoId = $this->getEstadoIdByName($row[5] ?? null);
                $municipioId = $this->getMunicipioIdByName($row[6] ?? null);
                $parroquiaId = $this->getParroquiaIdByName($row[7] ?? null);

                if (!$estadoId) {
                    $this->errores[] = "Fila " . ($index + 1) . ": estado no encontrado.";
                    continue;
                }

                Caso::create([
                    'numero_caso' => $row[1] ?? null,
                    'periodo' => $row[2] ?? null,
                    'fecha_atencion' => $this->transformDate($row[3] ?? null),
                    'fecha_actual' => $this->transformDate($row[4] ?? null),
                    'estado_id' => $estadoId,
                    'municipio_id' => $municipioId,
                    'parroquia_id' => $parroquiaId,
                    'estado_destino_id' => $this->getEstadoIdByName($row[8] ?? null),
                    'municipio_destino_id' => $this->getMunicipioIdByName($row[9] ?? null),
                    'parroquia_destino_id' => $this->getParroquiaIdByName($row[10] ?? null),
                    'direccion_domicilio' => $row[11] ?? null,
                    'numero_contacto' => $row[12] ?? null,
                    'elaborado_por' => $row[13] ?? null,
                    'tipo_atencion' => $row[14] ?? null,
                    'beneficiario' => $row[15] ?? null,
                    'edad_beneficiario' => $row[16] ?? null,
                    'poblacion_lgbti' => $row[17] ?? 'No',
                    'representante_legal' => $row[18] ?? null,
                    'pais_procedencia' => $row[19] ?? null,
                    'otro_pais' => $row[20] ?? null,
                    'nacionalidad_solicitante' => $row[21] ?? null,
                    'tipo_documento' => $row[22] ?? null,
                    'pais_nacimiento' => $row[23] ?? null,
                    'otro_pais_nacimiento' => $row[24] ?? null,
                    'etnia_indigena' => $row[25] ?? null,
                    'otra_etnia' => $row[26] ?? null,
                    'estatus' => $row[27] ?? null,
                    'observaciones' => $row[28] ?? null,
                    'verificador' => $row[29] ?? null,
                    'organizacion_programa' => $row[30] ?? null,
                    'organizacion_solicitante' => $row[31] ?? null,
                    'otras_organizaciones' => $row[32] ?? null,
                    'tipo_atencion_programa' => $row[33] ?? null,
                    'educacion' => $row[34] ?? null,
                    'nivel_educativo' => $row[35] ?? null,
                    'tipo_institucion' => $row[36] ?? null,
                    'estado_mujer' => $row[37] ?? null,
                    'acompanante' => $row[38] ?? null,
                    'servicio_brindado_cosude' => $row[39] ?? null,
                    'servicio_brindado_unicef' => $row[40] ?? null,
                    'tipo_actuacion' => $row[41] ?? null,
                    'otro_tipo_actuacion' => $row[42] ?? null,
                    'vulnerabilidades' => $this->parseList($row[43] ?? ''),
                    'derechos_vulnerados' => $this->parseList($row[44] ?? ''),
                    'identificacion_violencia' => $this->parseList($row[45] ?? ''),
                    'tipos_violencia_vicaria' => $this->parseList($row[46] ?? ''),
                    'remisiones' => $this->parseList($row[47] ?? ''),
                    'otras_remisiones' => $row[48] ?? null,
                    'indicadores' => $this->parseList($row[49] ?? ''),
                    'user_id' => Auth::id(),
                ]);

                $this->importados++;
            } catch (\Throwable $e) {
                $this->errores[] = "Fila " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        session()->flash('importados', $this->importados);
        session()->flash('errores_importacion', $this->errores);
    }

private function transformDate($value)
{
    if (!$value) return null;

    try {
        // Si es una fecha de Excel (número serial)
        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        // Si es texto en formato dd/mm/yyyy
        if (preg_match('/\d{2}\/\d{2}\/\d{4}/', $value)) {
            return \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        }

        // Si ya está en formato yyyy-mm-dd
        if (preg_match('/\d{4}-\d{2}-\d{2}/', $value)) {
            return $value;
        }

        return null; // formato no reconocido
    } catch (\Throwable $e) {
        return null;
    }
}


    private function parseList($string)
    {
        return json_encode(array_map('trim', explode(',', $string)));
    }

    private function getEstadoIdByName($nombre)
    {
        return Estado::where('nombre', trim($nombre))->value('id');
    }

    private function getMunicipioIdByName($nombre)
    {
        return Municipio::where('nombre', trim($nombre))->value('id');
    }

    private function getParroquiaIdByName($nombre)
    {
        return Parroquia::where('nombre', trim($nombre))->value('id');
    }
}
