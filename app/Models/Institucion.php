<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
class Institucion extends Model
{
    protected $collection = 'instituciones'; // Nombre de la colección en MongoDB

    protected $fillable = [
        'nombre',
        'direccion',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'direccion' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true; // Permite que Laravel maneje automáticamente created_at y updated_at
}