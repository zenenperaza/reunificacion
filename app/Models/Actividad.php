<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndicadorProyecto;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    public function indicadoresProyecto()
    {
        return $this->belongsToMany(
            IndicadorProyecto::class,
            'actividad_indicador',
            'actividad_id',
            'indicador_proyecto_id'
        )->withTimestamps()
         ->withPivot(['meta']);
    }
}