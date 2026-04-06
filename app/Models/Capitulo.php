<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    protected $fillable = [
        'nombre',
        'numero',
        'descripcion',
        'video_url'
    ];
}