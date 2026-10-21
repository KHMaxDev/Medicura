<?php

namespace App\Services;

use App\Models\DoctorPatient;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class PatientService
{
    public function forDoctor(User $doctor): Collection
    {
        $patientIds = DoctorPatient::query()
            ->where('doctor_id', $doctor->getKey())
            ->pluck('patient_id')
            ->all();

        if ($patientIds === []) {
            return new Collection;
        }

        return User::query()
            ->patients()
            ->whereIn('id', $patientIds)
            ->orderBy('apellido_paterno')
            ->orderBy('nombre')
            ->get();
    }

    public function search(User $doctor, string $nombre, ?string $apellidoPaterno = null, ?string $apellidoMaterno = null): Collection
    {
        $attached = DoctorPatient::query()
            ->where('doctor_id', $doctor->getKey())
            ->pluck('patient_id')
            ->all();

        return User::query()
            ->patients()
            ->where('nombre', 'like', '%'.trim($nombre).'%')
            ->when($apellidoPaterno, fn ($query) => $query->where('apellido_paterno', 'like', '%'.trim($apellidoPaterno).'%'))
            ->when($apellidoMaterno, fn ($query) => $query->where('apellido_materno', 'like', '%'.trim($apellidoMaterno).'%'))
            ->when($attached !== [], fn ($query) => $query->whereNotIn('id', $attached))
            ->limit(25)
            ->get();
    }

    public function attach(User $doctor, User $patient): void
    {
        if (! $doctor->isDoctor() || ! $patient->isPatient()) {
            throw ValidationException::withMessages([
                'patient' => 'El usuario seleccionado no es un paciente válido.',
            ]);
        }

        DoctorPatient::query()->firstOrCreate([
            'doctor_id' => $doctor->getKey(),
            'patient_id' => $patient->getKey(),
        ]);
    }

    public function detach(User $doctor, User $patient): void
    {
        DoctorPatient::query()
            ->where('doctor_id', $doctor->getKey())
            ->where('patient_id', $patient->getKey())
            ->delete();
    }

    public function owns(User $doctor, User $patient): bool
    {
        return DoctorPatient::query()
            ->where('doctor_id', $doctor->getKey())
            ->where('patient_id', $patient->getKey())
            ->exists();
    }
}
