<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_cliente extends Model
{
    use HasFactory;
    protected $table ='usuario_cliente';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'correo',
        'estado'
    ]; 
}
