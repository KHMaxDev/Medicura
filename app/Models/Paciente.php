<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Paciente extends Model
{
    protected $collection = 'users'; // Nombre de la colección en MongoDB

    protected $fillable = [
        'nombre',
        'direccion', // Se permite la asignación masiva como array
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'direccion' => 'array', // Para asegurar que se maneje como un array en PHP
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true; // Permite que Laravel maneje automáticamente created_at y updated_at
}