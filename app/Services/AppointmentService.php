<?php

namespace App\Services;

use App\Models\Cita;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    public function create(array $data): Cita
    {
        $this->assertAvailable(
            $data['doctor_id'],
            $data['patient_id'],
            $data['fecha'],
            $data['hora_inicio'],
            $data['hora_fin'],
        );

        return Cita::query()->create([
            'doctor_id' => $data['doctor_id'],
            'patient_id' => $data['patient_id'],
            'fecha' => $data['fecha'],
            'hora_inicio' => $data['hora_inicio'],
            'hora_fin' => $data['hora_fin'],
            'razon' => $data['razon'],
            'acciones' => $this->actions($data['acciones'] ?? null),
        ]);
    }

    public function update(Cita $cita, array $data): Cita
    {
        $this->assertAvailable(
            $data['doctor_id'],
            $data['patient_id'],
            $data['fecha'],
            $data['hora_inicio'],
            $data['hora_fin'],
            $cita->getKey(),
        );

        $cita->update([
            'doctor_id' => $data['doctor_id'],
            'patient_id' => $data['patient_id'],
            'fecha' => $data['fecha'],
            'hora_inicio' => $data['hora_inicio'],
            'hora_fin' => $data['hora_fin'],
            'razon' => $data['razon'],
            'acciones' => $this->actions($data['acciones'] ?? null),
        ]);

        return $cita->refresh();
    }

    private function assertAvailable(
        string $doctorId,
        string $patientId,
        string $fecha,
        string $horaInicio,
        string $horaFin,
        ?string $ignoreId = null,
    ): void {
        $doctorConflict = Cita::query()
            ->where('doctor_id', $doctorId)
            ->whereDate('fecha', $fecha)
            ->where('hora_inicio', '<', $horaFin)
            ->where('hora_fin', '>', $horaInicio)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists();

        if ($doctorConflict) {
            throw ValidationException::withMessages([
                'hora_inicio' => 'El doctor ya tiene una cita en ese horario.',
            ]);
        }

        $patientConflict = Cita::query()
            ->where('patient_id', $patientId)
            ->whereDate('fecha', $fecha)
            ->where('hora_inicio', '<', $horaFin)
            ->where('hora_fin', '>', $horaInicio)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists();

        if ($patientConflict) {
            throw ValidationException::withMessages([
                'hora_inicio' => 'El paciente ya tiene una cita en ese horario.',
            ]);
        }
    }

    private function actions(?string $actions): array
    {
        if (! $actions) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $actions))));
    }
}
