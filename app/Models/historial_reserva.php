<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_reserva extends Model
{
    use HasFactory;
    
    protected $table ='historial_reserva';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_usuario',
        'fecha',
        'hora',
        'total',
        'id_pelicula'
    ]; 
}
