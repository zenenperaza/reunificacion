<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   protected $fillable = ['nombre'];

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

    public function casosOrigen()
    {
        return $this->hasMany(Caso::class, 'estado_id');
    }

    public function casosDestino()
    {
        return $this->hasMany(Caso::class, 'estado_destino_id');
    }
}
