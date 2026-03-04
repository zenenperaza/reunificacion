<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioActividad extends Model
{
    use HasFactory;

    protected $table = 'servicio_actividad';

    protected $fillable = [
        'actividad_indicador_id',
        'servicio_id',
        'cantidad_disponible',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
        'cantidad_disponible' => 'integer',
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

    public function scopeInactivos($query)
    {
        return $query->where('estatus', false);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */
    public function actividadIndicador()
    {
        return $this->belongsTo(ActividadIndicador::class, 'actividad_indicador_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}