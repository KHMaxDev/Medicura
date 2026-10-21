<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'razon',
        'acciones',
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'acciones' => 'array',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
