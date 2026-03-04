<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * ActividadesIndicador relacionadas (N:N) vía servicio_actividad
     */
    public function actividadIndicador()
    {
        return $this->belongsToMany(ActividadIndicador::class, 'servicio_actividad')
            ->withPivot(['id', 'estatus', 'cantidad_disponible'])
            ->withTimestamps();
    }

    /**
     * Acceso directo a los registros de la pivote servicio_actividad
     */
    public function servicioActividad()
    {
        return $this->hasMany(ServicioActividad::class, 'servicio_id');
    }
}