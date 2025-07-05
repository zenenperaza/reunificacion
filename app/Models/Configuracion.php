<?php

// app/Models/Configuracion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones'; // 👈 nombre correcto de la tabla
    protected $fillable = ['clave', 'valor', 'descripcion'];

    public static function obtener($clave, $default = null)
    {
        return static::where('clave', $clave)->value('valor') ?? $default;
    }

    public static function establecer($clave, $valor)
    {
        return static::updateOrCreate(['clave' => $clave], ['valor' => $valor]);
    }
}
