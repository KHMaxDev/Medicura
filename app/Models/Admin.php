<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens; // <-- Agregar este trait

    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = ['nombre','tipo','email', 'contrasena']; // Agregar contrasena
    protected $primaryKey = '_id';
    public $timestamps = false;

    protected $casts = [
        '_id' => 'string'
    ];

    public function validatePassword($password)
    {
        return $this->contrasena === $password; // Adaptar según tu método de hash
    }
}
