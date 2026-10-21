<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@medicura.local');
        $adminPassword = Hash::make(env('ADMIN_PASSWORD', 'Admin#2026'));
        $doctorPassword = Hash::make('Doctor#2026');
        $patientPassword = Hash::make('Paciente#2026');

        User::query()->updateOrCreate(
            ['email' => $adminEmail],
            [
                'nombre' => 'Administrador',
                'apellido_paterno' => 'Medicura',
                'apellido_materno' => null,
                'contrasena' => $adminPassword,
                'tipo' => User::TYPE_ADMIN,
                'estatus' => User::STATUS_ACTIVE,
                'curp' => null,
                'email_verified_at' => now(),
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'admin2@medicura.local'],
            [
                'nombre' => 'Laura',
                'apellido_paterno' => 'García',
                'apellido_materno' => 'Mendoza',
                'contrasena' => $adminPassword,
                'tipo' => User::TYPE_ADMIN,
                'estatus' => User::STATUS_ACTIVE,
                'curp' => null,
                'email_verified_at' => now(),
            ],
        );

        $nombres = [
            'Alejandro', 'María', 'Carlos', 'Ana', 'Jorge', 'Fernanda', 'Ricardo', 'Paola',
            'Sergio', 'Daniela', 'Héctor', 'Valeria', 'Manuel', 'Gabriela', 'Emilio',
            'Regina', 'Raúl', 'Camila', 'Arturo', 'Renata',
        ];
        $apellidos = [
            'Hernández', 'García', 'Martínez', 'López', 'González', 'Pérez', 'Rodríguez',
            'Sánchez', 'Ramírez', 'Cruz', 'Flores', 'Gómez', 'Morales', 'Vázquez', 'Reyes',
            'Jiménez', 'Torres', 'Díaz', 'Ruiz', 'Mendoza',
        ];
        $especialidades = [
            'Medicina general', 'Pediatría', 'Cardiología', 'Dermatología', 'Ginecología',
            'Traumatología', 'Neurología', 'Oftalmología', 'Psiquiatría', 'Endocrinología',
        ];
        $instituciones = ['IMSS', 'ISSSTE', 'Secretaría de Salud', 'Hospital Ángeles', 'Clínica Medicura'];
        $generos = ['Masculino', 'Femenino', 'No especifica'];

        for ($i = 1; $i <= 20; $i++) {
            $email = $i === 1 ? 'doctor@medicura.local' : sprintf('doctor%02d@medicura.local', $i);

            User::query()->updateOrCreate(
                ['email' => $email],
                [
                    'nombre' => $nombres[$i - 1],
                    'apellido_paterno' => $apellidos[$i - 1],
                    'apellido_materno' => $apellidos[($i + 4) % 20],
                    'contrasena' => $doctorPassword,
                    'tipo' => User::TYPE_DOCTOR,
                    'estatus' => User::STATUS_ACTIVE,
                    'celular' => '55'.str_pad((string) (10000000 + $i), 8, '0', STR_PAD_LEFT),
                    'fecha_nacimiento' => Carbon::now()->subYears(30)->subDays($i * 17)->toDateString(),
                    'genero' => $generos[$i % 3],
                    'curp' => $this->curp('DOC', $i),
                    'cedula' => (string) (7000000 + $i),
                    'especialidad' => $especialidades[($i - 1) % count($especialidades)],
                    'institucion' => $instituciones[($i - 1) % count($instituciones)],
                    'email_verified_at' => now(),
                ],
            );

            $patientEmail = $i === 1 ? 'paciente@medicura.local' : sprintf('paciente%02d@medicura.local', $i);

            User::query()->updateOrCreate(
                ['email' => $patientEmail],
                [
                    'nombre' => $nombres[($i + 6) % 20],
                    'apellido_paterno' => $apellidos[($i + 2) % 20],
                    'apellido_materno' => $apellidos[($i + 9) % 20],
                    'contrasena' => $patientPassword,
                    'tipo' => User::TYPE_PATIENT,
                    'estatus' => User::STATUS_ACTIVE,
                    'celular' => '55'.str_pad((string) (20000000 + $i), 8, '0', STR_PAD_LEFT),
                    'fecha_nacimiento' => Carbon::now()->subYears(25)->subDays($i * 23)->toDateString(),
                    'genero' => $generos[($i + 1) % 3],
                    'curp' => $this->curp('PAC', $i),
                    'cedula' => null,
                    'especialidad' => null,
                    'institucion' => null,
                    'email_verified_at' => now(),
                ],
            );
        }

        User::query()->updateOrCreate(
            ['email' => 'cuidador@medicura.local'],
            [
                'nombre' => 'Patricia',
                'apellido_paterno' => 'Navarro',
                'apellido_materno' => 'Silva',
                'contrasena' => Hash::make('Cuidador#2026'),
                'tipo' => User::TYPE_CAREGIVER,
                'estatus' => User::STATUS_ACTIVE,
                'celular' => '5512345678',
                'genero' => 'Femenino',
                'curp' => $this->curp('CUI', 1),
                'email_verified_at' => now(),
            ],
        );

        $this->command?->info('Usuarios de ejemplo creados: 2 administradores, 20 doctores, 20 pacientes y 1 cuidador.');
    }

    private function curp(string $prefix, int $number): string
    {
        return strtoupper($prefix.str_pad((string) $number, 6, '0', STR_PAD_LEFT).'HDFR'.str_pad((string) $number, 5, '0', STR_PAD_LEFT));
    }
}
