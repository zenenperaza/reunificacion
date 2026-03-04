<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadIndicador extends Model
{
    use HasFactory;

    protected $table = 'actividad_indicador';

    protected $fillable = [
        'indicador_proyecto_id',
        'actividad_id',
        'meta',
        'estatus',
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

    public function indicadorProyecto()
    {
        return $this->belongsTo(IndicadorProyecto::class, 'indicador_proyecto_id');
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    /**
     * Servicios relacionados (N:N) vía servicio_actividad
     * El estatus/cantidad_disponible están en la pivote.
     */
    public function servicios()
    {
        return $this->belongsToMany(
            Servicio::class,
            'servicio_actividad',
            'actividad_indicador_id',
            'servicio_id'
        )
        ->withPivot(['id', 'cantidad_disponible', 'estatus']) // 'id' opcional pero útil
        ->withTimestamps();
    }

    /**
     * Solo servicios activos según estatus de la pivote servicio_actividad
     */
    public function serviciosActivos()
    {
        return $this->servicios()->wherePivot('estatus', true);
    }

    /**
     * Acceso directo a los registros de la pivote servicio_actividad
     */
    public function servicioActividad()
    {
        return $this->hasMany(ServicioActividad::class, 'actividad_indicador_id');
    }

    /**
     * Solo pivotes activos (servicio_actividad.estatus = true)
     */
    public function servicioActividadActivas()
    {
        return $this->servicioActividad()->where('estatus', true);
    }
}