<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = 'medicines';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'efectos_secundarios',
        'interacciones',
    ];

    protected $casts = [
        'efectos_secundarios' => 'array',
        'interacciones' => 'array',
    ];
}
