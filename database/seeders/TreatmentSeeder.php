<?php

namespace Database\Seeders;

use App\Models\DoctorPatient;
use App\Models\Tratamiento;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $doctores = User::query()->doctors()->active()->orderBy('id')->get();

        $tratamientos = [
            ['Control de hipertensión', 'Monitoreo de presión arterial y ajuste de medicación.', 90, 'Losartán 50 mg cada 24 horas'],
            ['Manejo de diabetes', 'Seguimiento glucémico y plan alimenticio personalizado.', 180, 'Metformina 850 mg cada 12 horas'],
            ['Tratamiento antibiótico', 'Esquema para infección respiratoria alta.', 7, 'Amoxicilina 500 mg cada 8 horas'],
            ['Control de asma', 'Plan de acción y técnica de inhalación.', 120, 'Salbutamol a demanda'],
            ['Manejo del dolor', 'Tratamiento analgésico y seguimiento.', 14, 'Paracetamol 500 mg cada 8 horas'],
            ['Salud dermatológica', 'Cuidados locales y control de lesiones.', 60, 'Hidrocortisona tópica cada 12 horas'],
            ['Seguimiento pediátrico', 'Control de crecimiento y desarrollo.', 365, 'Vitaminas pediátricas diarias'],
            ['Salud cardiovascular', 'Prevención y control de factores de riesgo.', 180, 'Aspirina 100 mg cada 24 horas'],
            ['Manejo de ansiedad', 'Intervención breve y seguimiento emocional.', 90, 'Sertralina 50 mg cada 24 horas'],
            ['Control de tiroides', 'Seguimiento hormonal y ajuste de dosis.', 120, 'Levotiroxina 50 mcg cada 24 horas'],
            ['Rehabilitación física', 'Ejercicios guiados y control del dolor.', 45, 'Ibuprofeno 400 mg cada 8 horas'],
            ['Control de alergias', 'Identificación de desencadenantes y tratamiento.', 30, 'Loratadina 10 mg cada 24 horas'],
            ['Salud digestiva', 'Manejo de síntomas gástricos y dieta.', 30, 'Omeprazol 20 mg cada 24 horas'],
            ['Control de infección urinaria', 'Tratamiento y medidas preventivas.', 10, 'Ciprofloxacino 500 mg cada 12 horas'],
            ['Seguimiento nutricional', 'Plan alimenticio y medición de indicadores.', 90, 'Suplemento nutricional diario'],
            ['Control de migraña', 'Identificación de detonantes y tratamiento preventivo.', 120, 'Propranolol 40 mg cada 12 horas'],
            ['Salud visual', 'Valoración y cuidados preventivos.', 180, 'Gotas lubricantes según necesidad'],
            ['Manejo de osteoporosis', 'Suplementación y prevención de caídas.', 365, 'Calcio y vitamina D diarios'],
            ['Control de colesterol', 'Cambios en estilo de vida y seguimiento.', 180, 'Atorvastatina 20 mg cada 24 horas'],
            ['Consulta preventiva', 'Valoración integral y recomendaciones.', 365, 'Ácido fólico diario'],
        ];

        foreach ($doctores as $index => $doctor) {
            $patientId = DoctorPatient::query()
                ->where('doctor_id', $doctor->getKey())
                ->orderBy('patient_id')
                ->value('patient_id');

            if (! $patientId) {
                continue;
            }

            [$nombre, $descripcion, $duracion, $dosis] = $tratamientos[$index % count($tratamientos)];

            Tratamiento::query()->updateOrCreate(
                [
                    'doctor_id' => $doctor->getKey(),
                    'patient_id' => $patientId,
                    'nombre_tratamiento' => $nombre,
                ],
                [
                    'descripcion' => $descripcion,
                    'duracion' => $duracion,
                    'dosis' => $dosis,
                    'fecha_creacion' => Carbon::today()->subDays($index)->toDateString(),
                ],
            );
        }

        $this->command?->info('Tratamientos de ejemplo creados: '.Tratamiento::query()->count().'.');
    }
}
