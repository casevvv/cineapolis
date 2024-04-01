<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_snack extends Model
{
    use HasFactory;
    
    protected $table ='historial_snack';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_snack',
        'cantiad',
        'precio',
        'total',
        'id_reserva'
    ]; 
}
