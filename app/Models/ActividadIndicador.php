<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndicadorProyecto;
use App\Models\Actividad;
use App\Models\Servicio;
use App\Models\ServicioActividad;

class ActividadIndicador extends Model
{
    use HasFactory;

    protected $table = 'actividad_indicador';

    protected $fillable = [
        'indicador_proyecto_id',
        'actividad_id',
        'meta',
        'estatus', // ✅ nuevo
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

    public function indicadorProyecto()
    {
        return $this->belongsTo(IndicadorProyecto::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    /**
     * Servicios relacionados (via servicio_actividad)
     * OJO: el estatus está en la pivote servicio_actividad
     */
    public function servicios()
    {
        return $this->belongsToMany(
            Servicio::class,
            'servicio_actividad',
            'actividad_indicador_id',
            'servicio_id'
        )
        ->withPivot(['cantidad_disponible', 'estatus']) // ✅ cantidad + estatus pivote
        ->withTimestamps();

        // Si quieres traer SOLO servicios activos (por estatus de la pivote):
        // ->wherePivot('estatus', true);
    }

    /**
     * Acceso directo a los registros de la pivote servicio_actividad
     */
    public function servicioActividad()
    {
        return $this->hasMany(ServicioActividad::class, 'actividad_indicador_id');

        // Si quieres SOLO activos:
        // return $this->hasMany(ServicioActividad::class, 'actividad_indicador_id')->where('estatus', true);
    }
}