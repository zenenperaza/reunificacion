<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;
use App\Models\IndicadorProyecto;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';

    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'indicador_proyecto')
            ->withTimestamps();
    }

    // Acceso directo a la pivote como modelo
    public function indicadorProyecto()
    {
        return $this->hasMany(IndicadorProyecto::class);
    }
}