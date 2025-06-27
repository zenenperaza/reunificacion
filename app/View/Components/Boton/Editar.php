<?php

namespace App\View\Components\Boton;

use Illuminate\View\Component;

class Editar extends Component
{
    public $ruta;
    public $modelo;
    public $permiso;
    public $texto;

    public function __construct($ruta, $modelo, $permiso = 'editar', $texto = 'Editar')
    {
        $this->ruta = $ruta;
        $this->modelo = $modelo;
        $this->permiso = $permiso;
        $this->texto = $texto;
    }

    public function render()
    {
        return view('components.boton.editar');
    }
}
