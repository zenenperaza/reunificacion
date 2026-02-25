<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActividadIndicador;
use App\Models\Servicio;

class ServicioActividad extends Model
{
    use HasFactory;

    protected $table = 'servicio_actividad';

    protected $fillable = [
        'actividad_indicador_id',
        'servicio_id',
        'cantidad_disponible',
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

    public function actividadIndicador()
    {
        return $this->belongsTo(ActividadIndicador::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}