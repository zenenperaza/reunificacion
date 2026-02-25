<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;
use App\Models\Indicador;
use App\Models\Actividad;
use App\Models\ActividadIndicador;

class IndicadorProyecto extends Model
{
    use HasFactory;

    protected $table = 'indicador_proyecto';

    protected $fillable = [
        'proyecto_id',
        'indicador_id',
        'estatus',           // ✅ nuevo
        'meta_cuantitativa',
        'meta_cualitativa',
    ];

    protected $casts = [
        'estatus' => 'boolean', // ✅ nuevo
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeActivos($query)
    {
        return $query->where('estatus', true);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function indicador()
    {
        return $this->belongsTo(Indicador::class);
    }

    /**
     * Actividades relacionadas (via actividad_indicador)
     * OJO: aquí el estatus está en actividad_indicador, no en actividades.
     */
    public function actividades()
    {
        return $this->belongsToMany(
            Actividad::class,
            'actividad_indicador',
            'indicador_proyecto_id',
            'actividad_id'
        )
        ->withPivot(['meta', 'estatus'])  // ✅ meta + estatus de la pivote
        ->withTimestamps();

        // Si quieres traer SOLO actividades activas (por estatus de la pivote), usa esto:
        // ->wherePivot('estatus', true);
    }

    /**
     * Acceso directo a la pivote actividad_indicador
     */
    public function actividadIndicador()
    {
        return $this->hasMany(ActividadIndicador::class);

        // Si quieres SOLO activas:
        // return $this->hasMany(ActividadIndicador::class)->where('estatus', true);
    }
}