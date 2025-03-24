<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Medicamentos extends Model
{
    protected $connection = 'mongodb'; 
    protected $collection = 'medicamentos';
    protected $primaryKey = '_id';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'efectos_secundarios',
        'interacciones',
        'tipo',
        'created_at',
        'updated_at'
    ];
}
