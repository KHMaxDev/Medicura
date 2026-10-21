<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institutions';

    protected $fillable = [
        'nombre',
        'direccion',
    ];

    protected $casts = [
        'direccion' => 'array',
    ];
}
