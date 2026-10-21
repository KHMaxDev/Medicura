<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\DoctorPatient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $doctores = User::query()->doctors()->active()->orderBy('id')->get();

        foreach ($doctores as $index => $doctor) {
            $patientIds = DoctorPatient::query()
                ->where('doctor_id', $doctor->getKey())
                ->orderBy('patient_id')
                ->pluck('patient_id');

            if ($patientIds->isEmpty()) {
                continue;
            }

            $patient = User::query()->find($patientIds->first());

            if (! $patient) {
                continue;
            }

            $fecha = Carbon::today()->addDays($index + 1);

            Cita::query()->updateOrCreate(
                [
                    'doctor_id' => $doctor->getKey(),
                    'patient_id' => $patient->getKey(),
                    'fecha' => $fecha->toDateString(),
                    'hora_inicio' => '09:00',
                ],
                [
                    'hora_fin' => '09:30',
                    'razon' => 'Consulta de seguimiento '.($index + 1),
                    'acciones' => ['Revisar signos vitales', 'Actualizar expediente'],
                ],
            );

            Cita::query()->updateOrCreate(
                [
                    'doctor_id' => $doctor->getKey(),
                    'patient_id' => $patient->getKey(),
                    'fecha' => $fecha->copy()->addDays(20)->toDateString(),
                    'hora_inicio' => '10:00',
                ],
                [
                    'hora_fin' => '10:30',
                    'razon' => 'Consulta de control '.($index + 1),
                    'acciones' => ['Revisar tratamiento', 'Solicitar estudios'],
                ],
            );
        }

        $this->command?->info('Citas de ejemplo creadas: '.Cita::query()->count().'.');
    }
}
