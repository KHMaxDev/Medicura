<?php

namespace App\Services;

use App\Models\Cita;
use App\Models\Institucion;
use App\Models\Medicamento;
use App\Models\Tratamiento;
use App\Models\User;
use Illuminate\Support\Carbon;

class ReportService
{
    public function adminMetrics(): array
    {
        return [
            'doctoresActivos' => User::query()->doctors()->active()->count(),
            'doctoresPendientes' => User::query()->doctors()->where('estatus', User::STATUS_PENDING)->count(),
            'pacientes' => User::query()->patients()->count(),
            'cuidadores' => User::query()->where('tipo', User::TYPE_CAREGIVER)->count(),
            'instituciones' => Institucion::query()->count(),
            'medicamentos' => Medicamento::query()->count(),
            'citas' => Cita::query()->count(),
            'mes' => Carbon::now()->locale('es')->translatedFormat('F Y'),
        ];
    }

    public function doctorMetrics(User $doctor): array
    {
        $patientIds = $doctor->doctorLinks()->pluck('patient_id')->all();

        return [
            'pacientes' => count($patientIds),
            'citasHoy' => Cita::query()
                ->where('doctor_id', $doctor->getKey())
                ->whereDate('fecha', today())
                ->count(),
            'tratamientos' => Tratamiento::query()
                ->where('doctor_id', $doctor->getKey())
                ->count(),
            'proximaCita' => Cita::query()
                ->with('patient')
                ->where('doctor_id', $doctor->getKey())
                ->whereDate('fecha', '>=', today())
                ->orderBy('fecha')
                ->orderBy('hora_inicio')
                ->first(),
        ];
    }
}
