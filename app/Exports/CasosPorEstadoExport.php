<?php

namespace App\Exports;

use App\Models\Estado;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CasosPorEstadoExport implements WithMultipleSheets
{
    protected $start;
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Obtiene todos los estados con al menos un caso
        $estados = Estado::whereHas('casos')->get();

        foreach ($estados as $estado) {
            $sheets[] = new CasosExport($this->start, $this->end, $estado->id, null); // null para estatus
        }

        return $sheets;
    }
}

