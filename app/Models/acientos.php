<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acientos extends Model
{
    use HasFactory;
    protected $table ='acientos';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_pelicula',
        'aciento',
        'ciudad',
        'fecha',
        'hora',
        'id_reserva'
    ];   
}
