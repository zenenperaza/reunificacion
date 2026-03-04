<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorProyecto extends Model
{
    use HasFactory;

    protected $table = 'indicador_proyecto';

    protected $fillable = [
        'proyecto_id',
        'indicador_id',
        'estatus',
        'meta_cuantitativa',
        'meta_cualitativa',
    ];

    protected $casts = [
        'estatus' => 'boolean',
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
     * Actividades relacionadas (N:N) vía actividad_indicador
     * El estatus/meta están en la pivote (actividad_indicador).
     */
    public function actividades()
    {
        return $this->belongsToMany(
            Actividad::class,
            'actividad_indicador',
            'indicador_proyecto_id',
            'actividad_id'
        )
        ->withPivot(['id', 'meta', 'estatus']) // 'id' opcional pero útil
        ->withTimestamps();
    }

    /**
     * Solo actividades activas según estatus de la pivote
     */
    public function actividadesActivas()
    {
        return $this->actividades()->wherePivot('estatus', true);
    }

    /**
     * Acceso directo a los registros de la pivote actividad_indicador
     */
    public function actividadIndicador()
    {
        return $this->hasMany(ActividadIndicador::class, 'indicador_proyecto_id');
    }

    /**
     * Solo registros activos de actividad_indicador
     */
    public function actividadIndicadorActivas()
    {
        return $this->actividadIndicador()->where('estatus', true);
    }
}