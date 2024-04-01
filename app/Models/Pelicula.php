<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion', 'sala', 'imagen', 'estado',
    ];
}
