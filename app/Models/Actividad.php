<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    /**
     * IndicadoresProyecto relacionados (N:N) vía actividad_indicador
     */
    public function indicadorProyecto()
    {
        return $this->belongsToMany(IndicadorProyecto::class, 'actividad_indicador')
            ->withPivot(['id', 'estatus', 'meta'])
            ->withTimestamps();
    }

    /**
     * Acceso directo a los registros de la pivote actividad_indicador
     */
    public function actividadIndicador()
    {
        return $this->hasMany(ActividadIndicador::class, 'actividad_id');
    }
}