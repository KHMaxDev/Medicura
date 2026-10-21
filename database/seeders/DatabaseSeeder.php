<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            InstitutionSeeder::class,
            MedicineSeeder::class,
            DoctorPatientSeeder::class,
            AppointmentSeeder::class,
            TreatmentSeeder::class,
        ]);

        $this->command?->info('Datos de ejemplo de Medicura cargados correctamente.');
    }
}
