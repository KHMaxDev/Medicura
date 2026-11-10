<?php

namespace App\Data;

/** The single seed for the demo. No models, accounts or database connection. */
final class DemoData
{
    public static function all(): array
    {
        $doctors = [
            ['id' => 'd1', 'name' => 'Elena Martínez', 'email' => 'elena@example.test', 'specialty' => 'Medicina general', 'institution_id' => 'i1', 'status' => 'Activo', 'phone' => '998 555 0101', 'license' => 'DEMO-1001'],
            ['id' => 'd2', 'name' => 'Andrés Navarro', 'email' => 'andres@example.test', 'specialty' => 'Cardiología', 'institution_id' => 'i1', 'status' => 'Activo', 'phone' => '998 555 0102', 'license' => 'DEMO-1002'],
            ['id' => 'd3', 'name' => 'Sofía Reyes', 'email' => 'sofia@example.test', 'specialty' => 'Pediatría', 'institution_id' => 'i2', 'status' => 'Activo', 'phone' => '998 555 0103', 'license' => 'DEMO-1003'],
            ['id' => 'd4', 'name' => 'Gabriel Torres', 'email' => 'gabriel@example.test', 'specialty' => 'Medicina interna', 'institution_id' => 'i2', 'status' => 'Pendiente', 'phone' => '998 555 0104', 'license' => 'DEMO-1004'],
            ['id' => 'd5', 'name' => 'Valentina Cruz', 'email' => 'valentina@example.test', 'specialty' => 'Dermatología', 'institution_id' => 'i3', 'status' => 'Pendiente', 'phone' => '998 555 0105', 'license' => 'DEMO-1005'],
            ['id' => 'd6', 'name' => 'Diego Mendoza', 'email' => 'diego@example.test', 'specialty' => 'Nutrición', 'institution_id' => 'i3', 'status' => 'Rechazado', 'phone' => '998 555 0106', 'license' => 'DEMO-1006'],
        ];
        $names = ['Lucía Fernández', 'Mateo García', 'Isabella López', 'Santiago Pérez', 'Camila Rodríguez', 'Sebastián Díaz', 'Mariana Flores', 'Daniel Hernández', 'Regina Morales', 'Emiliano Castro', 'Ana Jiménez', 'Alejandro Vega', 'Victoria Ramos', 'Nicolás Ortiz', 'Renata Silva', 'Leonardo Ríos', 'Valeria Luna', 'David Santos'];
        $patients = [];
        $appointments = [];
        $links = [];
        $today = now()->startOfDay();
        foreach ($names as $i => $name) {
            $id = 'p'.($i + 1);
            $patients[] = ['id' => $id, 'name' => $name, 'email' => 'paciente'.($i + 1).'@example.test', 'phone' => '998 555 '.str_pad((string) ($i + 201), 4, '0', STR_PAD_LEFT), 'birthdate' => (1980 + $i).'-06-15', 'gender' => $i % 2 ? 'Masculino' : 'Femenino', 'status' => 'Activo', 'curp' => 'DEMO'.str_pad((string) ($i + 1), 14, '0', STR_PAD_LEFT), 'notes' => 'Expediente ficticio para explorar la interfaz.'];
            $doctorId = $i < 10 ? 'd1' : ($i % 2 ? 'd2' : 'd3');
            $links[] = ['doctor_id' => $doctorId, 'patient_id' => $id];
            $appointments[] = ['id' => 'a'.($i + 1), 'doctor_id' => $doctorId, 'patient_id' => $id, 'date' => $today->copy()->addDays(intdiv($i, 5))->format('Y-m-d'), 'start' => sprintf('%02d:00', 9 + $i % 5), 'end' => sprintf('%02d:45', 9 + $i % 5), 'reason' => ['Consulta de seguimiento', 'Valoración general', 'Revisión periódica'][$i % 3], 'status' => ['Confirmada', 'Pendiente', 'Confirmada'][$i % 3], 'notes' => 'Cita de demostración.'];
        }
        return [
            'version' => 1, 'today' => $today->format('Y-m-d'), 'doctorId' => 'd1',
            'doctors' => $doctors, 'patients' => $patients, 'appointments' => $appointments, 'links' => $links,
            'institutions' => [
                ['id' => 'i1', 'name' => 'Centro Médico del Caribe', 'address' => 'Av. del Sol 120, Cancún', 'phone' => '998 555 0200', 'email' => 'caribe@example.test', 'status' => 'Activo'],
                ['id' => 'i2', 'name' => 'Clínica Horizonte', 'address' => 'Calle Jardín 45, Cancún', 'phone' => '998 555 0300', 'email' => 'horizonte@example.test', 'status' => 'Activo'],
                ['id' => 'i3', 'name' => 'Unidad Médica Nativa', 'address' => 'Av. del Parque 80, Cancún', 'phone' => '998 555 0400', 'email' => 'nativa@example.test', 'status' => 'Activo'],
            ],
            'medicines' => [
                ['id' => 'm1', 'name' => 'Medicamento de ejemplo A', 'type' => 'Tableta', 'description' => 'Producto ficticio para explorar el catálogo.', 'effects' => 'Información de demostración', 'interactions' => 'No aplica'],
                ['id' => 'm2', 'name' => 'Medicamento de ejemplo B', 'type' => 'Solución', 'description' => 'Producto ficticio para explorar el catálogo.', 'effects' => 'Información de demostración', 'interactions' => 'No aplica'],
                ['id' => 'm3', 'name' => 'Medicamento de ejemplo C', 'type' => 'Cápsula', 'description' => 'Producto ficticio para explorar el catálogo.', 'effects' => 'Información de demostración', 'interactions' => 'No aplica'],
            ],
            'treatments' => array_map(fn ($i) => ['id' => 't'.$i, 'name' => 'Seguimiento de ejemplo '.$i, 'doctor_id' => 'd1', 'patient_id' => 'p'.$i, 'description' => 'Plan ficticio para demostrar la interfaz, sin indicaciones clínicas.', 'duration' => '7', 'dose' => 'No aplica — demostración', 'date' => $today->format('Y-m-d'), 'status' => $i === 4 ? 'Finalizado' : 'Activo'], range(1, 4)),
        ];
    }
}
