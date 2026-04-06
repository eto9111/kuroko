<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'correo',
        'celular',
        'personaje_favorito'
    ];
}
