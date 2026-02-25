<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donante;
use App\Models\Indicador;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\IndicadorProyecto;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'donante_id',
        'estatus',      // ✅ nuevo
        'codigo',
        'descripcion',
        'inicio',
        'fin',
    ];

    protected $casts = [
        'estatus' => 'boolean', // ✅ nuevo
        'inicio'  => 'date',
        'fin'     => 'date',
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

    // Proyecto pertenece a un Donante
    public function donante()
    {
        return $this->belongsTo(Donante::class);
    }

    /**
     * Indicadores del proyecto (pivote indicador_proyecto con campos extra)
     */
    public function indicadores()
    {
        return $this->belongsToMany(Indicador::class, 'indicador_proyecto')
            ->withPivot(['estatus', 'meta_cuantitativa', 'meta_cualitativa']) // ✅ nuevo
            ->withTimestamps();
    }

    // Acceso directo a la tabla pivote (para metas y estatus)
    public function indicadorProyecto()
    {
        return $this->hasMany(IndicadorProyecto::class);
    }

    // Proyecto tiene muchos estados
    public function estados()
    {
        return $this->belongsToMany(Estado::class, 'estado_proyecto')
            ->withTimestamps();
    }

    // Proyecto tiene muchos municipios
    public function municipios()
    {
        return $this->belongsToMany(Municipio::class, 'municipio_proyecto')
            ->withTimestamps();
    }
}