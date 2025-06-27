<?php
namespace App\View\Components\Boton;

use Illuminate\View\Component;

class Ver extends Component
{
    public $ruta;
    public $modelo;
    public $permiso;
    public $texto;

    public function __construct($ruta, $modelo, $permiso = 'ver', $texto = 'Ver')
    {
        $this->ruta = $ruta;
        $this->modelo = $modelo;
        $this->permiso = $permiso;
        $this->texto = $texto;
    }

    public function render()
    {
        return view('components.boton.ver');
    }
}
