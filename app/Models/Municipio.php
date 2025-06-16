<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
     protected $fillable = ['nombre', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function parroquias()
    {
        return $this->hasMany(Parroquia::class);
    }

    public function casosOrigen()
    {
        return $this->hasMany(Caso::class, 'municipio_id');
    }

    public function casosDestino()
    {
        return $this->hasMany(Caso::class, 'municipio_destino_id');
    }
}
