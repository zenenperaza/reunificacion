<?php

namespace App\View\Components\Boton;

use Illuminate\View\Component;

class Crear extends Component
{
    public $ruta;
    public $permiso;
    public $texto;

    public function __construct($ruta, $permiso = 'crear', $texto = 'Crear')
    {
        $this->ruta = $ruta;
        $this->permiso = $permiso;
        $this->texto = $texto;
    }

    public function render()
    {
        return view('components.boton.crear');
    }
}
