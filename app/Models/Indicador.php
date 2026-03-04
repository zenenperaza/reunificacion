<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';

    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    /**
     * Proyectos relacionados (N:N) vía indicador_proyecto
     * (si solo quieres activos, filtra en la relación)
     */
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'indicador_proyecto')
            ->withPivot(['id', 'meta_cuantitativa', 'meta_cualitativa'])
            ->withTimestamps();
    }

    /**
     * Acceso directo a los registros de la pivote indicador_proyecto
     */
    public function indicadorProyecto()
    {
        return $this->hasMany(IndicadorProyecto::class, 'indicador_id');
    }
}