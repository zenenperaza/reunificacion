<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'photo', 'estatus', 'parent_id', 'es_superior',
    ];

    /**
     * Relaciones
     */

    public function casos()
    {
        return $this->hasMany(Caso::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * Scope para obtener los usuarios de la misma familia
     */
    public function scopeFamilia($query)
    {
        $usuario = auth()->user();

        $ids = collect([$usuario->id]);

        if ($usuario->parent_id) {
            $ids->push($usuario->parent_id);
        }

        $hijos = $usuario->children()->pluck('id');
        $ids = $ids->merge($hijos)->unique();

        return $query->whereIn('id', $ids);
    }

    /**
     * Atributos ocultos para serialización
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting de atributos
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
