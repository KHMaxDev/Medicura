<?php

namespace Database\Seeders;

use App\Models\DoctorPatient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorPatientSeeder extends Seeder
{
    public function run(): void
    {
        $doctores = User::query()->doctors()->active()->orderBy('id')->get();
        $pacientes = User::query()->patients()->active()->orderBy('id')->get();

        if ($doctores->isEmpty() || $pacientes->isEmpty()) {
            return;
        }

        foreach ($doctores as $index => $doctor) {
            $assigned = [
                $pacientes[$index % $pacientes->count()],
                $pacientes[($index + 1) % $pacientes->count()],
            ];

            foreach ($assigned as $patient) {
                DoctorPatient::query()->updateOrCreate([
                    'doctor_id' => $doctor->getKey(),
                    'patient_id' => $patient->getKey(),
                ]);
            }
        }

        $this->command?->info('Relaciones doctor-paciente creadas: '.DoctorPatient::query()->count().'.');
    }
}
