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

 
    public function scopeFamilia($query)
    {
        $usuario = auth()->user();
        $familias = $usuario->familias()->with('usuarios')->get();
        $ids = collect([$usuario->id]);

        foreach ($familias as $familia) {
            $usuariosFamilia = collect($familia->usuarios);

            $padres = $usuariosFamilia->where('pivot.rol', 'padre');
            $hijos  = $usuariosFamilia->where('pivot.rol', 'hijo');

            if ($padres->contains('id', $usuario->id)) {
                // Si es padre, ve a sus hijos
                $ids = $ids->merge($hijos->pluck('id'));
            }

            if ($hijos->contains('id', $usuario->id)) {
                // Si es hijo, ve al padre
                $ids = $ids->merge($padres->pluck('id'));

                // Si la familia permite ver entre hermanos
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
