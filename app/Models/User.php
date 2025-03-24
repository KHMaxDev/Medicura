<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
//use MongoDB\Laravel\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens; // <-- Agregar este trait
    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = [
        'nombre',
        'tipo',
        'email',
        'contrasena',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = '_id';
    protected $casts = [
        '_id' =>'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    
    protected $hidden = ['contrasena'];
    public $timestamps = true;

    public function validatePassword($password)
    {
        return $this->contrasena === $password;
    }
}
