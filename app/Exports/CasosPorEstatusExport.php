<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CasosPorEstatusExport implements WithMultipleSheets
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

        $estatuses = ['En proceso', 'En seguimiento', 'Finalizado'];

        foreach ($estatuses as $estatus) {
            $sheets[] = new CasosExport($this->start, $this->end, null, $estatus);
        }

        return $sheets;
    }
}

