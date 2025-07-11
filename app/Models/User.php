<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'photo',
        'estatus',
        'parent_id',
        'es_superior',
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

    public function familias()
    {
        return $this->belongsToMany(Familia::class)
            ->withPivot('rol')
            ->withTimestamps();
    }

    public function familiasComoPadre()
    {
        return $this->familias()->wherePivot('rol', 'padre');
    }

    public function familiaComoHijo()
    {
        return $this->familias()->wherePivot('rol', 'hijo')->first();
    }

    public function esPadreEn($familia_id)
    {
        return $this->familias()
            ->where('familias.id', $familia_id)
            ->wherePivot('rol', 'padre')
            ->exists();
    }

    public function esHijoEn($familia_id)
    {
        return $this->familias()
            ->where('familias.id', $familia_id)
            ->wherePivot('rol', 'hijo')
            ->exists();
    }

    /**
     * Scope para filtrar usuarios visibles por jerarquía familiar
     */
    public function scopeFamilia($query)
    {
        $usuario = auth()->user();
        $ids = collect([$usuario->id]);

        foreach ($usuario->familias as $familia) {
            $usuarios = $familia->usuarios;
            $padres = $usuarios->filter(fn($u) => $u->pivot->rol === 'padre');
            $hijos  = $usuarios->filter(fn($u) => $u->pivot->rol === 'hijo');

            if ($usuario->esPadreEn($familia->id)) {
                $ids = $ids->merge($hijos->pluck('id'));
            }

            if ($usuario->esHijoEn($familia->id)) {
                $ids = $ids->merge($padres->pluck('id'));
                if ($familia->ver_entre_hermanos) {
                    $ids = $ids->merge($hijos->pluck('id'));
                }
            }
        }

        return $query->whereIn('id', $ids->unique());
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
