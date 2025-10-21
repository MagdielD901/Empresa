<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'numero_serie',
        'estado',
        'usuario_id',
    ];

    // Relación: un dispositivo pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function users()
{
    return $this->belongsTo(User::class, 'usuario_id');
}



}


