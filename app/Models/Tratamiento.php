<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tratamiento extends Model
{
    protected $table = 'treatments';

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'nombre_tratamiento',
        'descripcion',
        'duracion',
        'dosis',
        'fecha_creacion',
    ];

    protected $casts = [
        'duracion' => 'integer',
        'fecha_creacion' => 'date:Y-m-d',
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
