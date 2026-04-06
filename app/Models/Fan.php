<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = ['nombre', 'correo', 'edad', 'personaje_favorito', 'equipo_favorito', 'motivo'];
}
