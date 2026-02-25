<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;

class Donante extends Model
{
    use HasFactory;

    protected $table = 'donantes';

    protected $fillable = [
        'nombre',
        'estatus',     // ✅ nuevo campo
        'enlaces',
    ];

    protected $casts = [
        'estatus' => 'boolean', // ✅ para activo/inactivo
        'enlaces' => 'array',   // JSON <-> array automático
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

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getNombreContactoAttribute()
    {
        return $this->enlaces['nombre_contacto'] ?? null;
    }

    public function getTelefonoContactoAttribute()
    {
        return $this->enlaces['telefono'] ?? null;
    }
}