<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public const TYPE_ADMIN = 'admin';

    public const TYPE_DOCTOR = 'doctor';

    public const TYPE_PATIENT = 'paciente';

    public const TYPE_CAREGIVER = 'cuidador';

    public const STATUS_PENDING = 'pendiente';

    public const STATUS_ACTIVE = 'activo';

    public const STATUS_INACTIVE = 'inactivo';

    public const STATUS_DENIED = 'denegado';

    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'contrasena',
        'tipo',
        'estatus',
        'celular',
        'fecha_nacimiento',
        'genero',
        'curp',
        'cedula',
        'especialidad',
        'institucion',
        'foto_perfil',
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword(): string
    {
        return (string) $this->contrasena;
    }

    public function getAuthPasswordName(): string
    {
        return 'contrasena';
    }

    public function setEmailAttribute(string $value): void
    {
        $this->attributes['email'] = Str::lower(trim($value));
    }

    public function setCurpAttribute(?string $value): void
    {
        $this->attributes['curp'] = $value ? Str::upper(trim($value)) : null;
    }

    public function getInstitucionAttribute($value): ?string
    {
        if (is_array($value)) {
            return implode(', ', array_filter($value));
        }

        return $value;
    }

    public function isAdmin(): bool
    {
        return $this->tipo === self::TYPE_ADMIN;
    }

    public function isDoctor(): bool
    {
        return $this->tipo === self::TYPE_DOCTOR;
    }

    public function isPatient(): bool
    {
        return $this->tipo === self::TYPE_PATIENT;
    }

    public function isActive(): bool
    {
        return $this->estatus === null || $this->estatus === self::STATUS_ACTIVE;
    }

    public function fullName(): string
    {
        return trim(implode(' ', array_filter([
            $this->nombre,
            $this->apellido_paterno,
            $this->apellido_materno,
        ])));
    }

    public function scopeDoctors($query)
    {
        return $query->where('tipo', self::TYPE_DOCTOR);
    }

    public function scopePatients($query)
    {
        return $query->where('tipo', self::TYPE_PATIENT);
    }

    public function scopeActive($query)
    {
        return $query->where('estatus', self::STATUS_ACTIVE);
    }

    public function appointmentsAsDoctor(): HasMany
    {
        return $this->hasMany(Cita::class, 'doctor_id');
    }

    public function appointmentsAsPatient(): HasMany
    {
        return $this->hasMany(Cita::class, 'patient_id');
    }

    public function treatmentsAsDoctor(): HasMany
    {
        return $this->hasMany(Tratamiento::class, 'doctor_id');
    }

    public function treatmentsAsPatient(): HasMany
    {
        return $this->hasMany(Tratamiento::class, 'patient_id');
    }

    public function doctorLinks(): HasMany
    {
        return $this->hasMany(DoctorPatient::class, 'doctor_id');
    }

    public function patientLinks(): HasMany
    {
        return $this->hasMany(DoctorPatient::class, 'patient_id');
    }
}
