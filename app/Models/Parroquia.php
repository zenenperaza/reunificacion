<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
   protected $fillable = ['nombre', 'municipio_id'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function casosOrigen()
    {
        return $this->hasMany(Caso::class, 'parroquia_id');
    }

    public function casosDestino()
    {
        return $this->hasMany(Caso::class, 'parroquia_destino_id');
    }
}
