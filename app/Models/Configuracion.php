<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';

    protected $fillable = [
        'conf_fecha_actual',
        'sistema_deshabilitado',
        'periodo',
        'nombre_sistema',
        'logo_sistema',
    ];
}
