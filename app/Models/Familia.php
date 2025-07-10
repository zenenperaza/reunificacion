<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $fillable = ['nombre', 'ver_entre_hermanos'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('rol')
            ->withTimestamps();
    }

    public function padres()
    {
        return $this->usuarios()->wherePivot('rol', 'padre');
    }

    public function hijos()
    {
        return $this->usuarios()->wherePivot('rol', 'hijo');
    }
}
