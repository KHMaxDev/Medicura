<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Nombre_del_Paciente',
        'Nombre_del_Doctor',
        'Fecha_del_Reporte',
        'Descripción',
        'Acciones',
    ];
}