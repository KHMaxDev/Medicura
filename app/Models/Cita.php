<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cita extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'citas';
    protected $primaryKey = '_id';

    public $timestamps = true;

    protected $fillable = [
        'id_doctor',
        'id_paciente',
        'doctor_nombre',
        'paciente_nombre',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'razon',
        'acciones',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];
}