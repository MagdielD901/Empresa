<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',         // Rol del usuario (ej: admin, programador)
        'department',   // Departamento (ej: desarrollo, administración)
        'active',       // Estado activo/inactivo
        'hired_at',     // Fecha de ingreso
        'avatar',       // Imagen del usuario
    ];

    /**
     * Los atributos que deben ocultarse en la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben convertirse a tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
            'hired_at' => 'datetime',
        ];
    }

    /**
     * Accesor para obtener el estado como texto (opcional).
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->active ? 'ACTIVO' : 'INACTIVO';
    }

    public function dispositivos()
{
    return $this->hasMany(Dispositivo::class, 'usuario_id');
}

}
