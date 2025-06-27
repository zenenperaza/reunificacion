<?php

namespace App\View\Components\Boton;

use Illuminate\View\Component;

class Eliminar extends Component
{
    public $ruta;
    public $modelo;
    public $permiso;

    public function __construct($ruta, $modelo, $permiso = 'eliminar')
    {
        $this->ruta = $ruta;
        $this->modelo = $modelo;
        $this->permiso = $permiso;
    }

    public function render()
    {
        return view('components.boton.eliminar');
    }
}
