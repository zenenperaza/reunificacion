<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActividadIndicador;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function actividadesIndicador()
    {
        return $this->belongsToMany(
            ActividadIndicador::class,
            'servicio_actividad',
            'servicio_id',
            'actividad_indicador_id'
        )->withTimestamps()
         ->withPivot(['cantidad_disponible']);
    }
}