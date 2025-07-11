<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';

    // En tu modelo App\Models\Configuracion
    protected $fillable = [
        'conf_fecha_actual',
        'sistema_deshabilitado',
        'periodo',
        'nombre_sistema',
        'logo_sistema',
        'texto_portada',
        'imagen_portada',
    ];
}
