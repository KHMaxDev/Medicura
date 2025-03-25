<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'tipo',
        'email',
        'contrasena',
        'estatus',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = '_id';

    protected $casts = [
        '_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $hidden = ['contrasena'];
    public $timestamps = true;

    // Método para verificar contraseñas hasheadas
    public function validatePassword($password)
    {
        return Hash::check($password, $this->contrasena);
    }
}
