<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens; // <-- Agregar este trait

    protected $collection = 'usuarios';
    protected $fillable = ['nombre', 'email', 'curp', 'contrasena']; // Agregar contrasena
    protected $primaryKey = '_id';
    public $timestamps = true;

    protected $casts = [
        '_id' => 'string'
    ];

    public function validatePassword($password)
    {
        return $this->contrasena === $password; // Adaptar según tu método de hash
    }
}
