<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table ='empleados';
    protected $primaryKey='id';
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'fechanac',
        'correo',
        'foto'
    ];
    protected $hidden=["created_at","updated_at"];
}
