<?php

namespace Database\Seeders;

use App\Models\Medicamento;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicamentos = [
            ['Paracetamol', 'Analgésico', 'Alivia el dolor y reduce la fiebre.', ['Náuseas', 'Erupción cutánea'], ['Alcohol']],
            ['Ibuprofeno', 'Antiinflamatorio', 'Reduce dolor, fiebre e inflamación.', ['Malestar estomacal', 'Mareo'], ['Aspirina', 'Anticoagulantes']],
            ['Amoxicilina', 'Antibiótico', 'Trata infecciones bacterianas.', ['Diarrea', 'Náuseas'], ['Metotrexato']],
            ['Loratadina', 'Antihistamínico', 'Controla síntomas de alergia.', ['Somnolencia', 'Sequedad bucal'], ['Ketoconazol']],
            ['Omeprazol', 'Protector gástrico', 'Reduce la producción de ácido estomacal.', ['Dolor abdominal', 'Estreñimiento'], ['Clopidogrel']],
            ['Metformina', 'Antidiabético', 'Controla los niveles de glucosa.', ['Diarrea', 'Náuseas'], ['Alcohol']],
            ['Losartán', 'Antihipertensivo', 'Ayuda a controlar la presión arterial.', ['Mareo', 'Fatiga'], ['Suplementos de potasio']],
            ['Salbutamol', 'Broncodilatador', 'Alivia broncoespasmos y asma.', ['Temblor', 'Palpitaciones'], ['Betabloqueadores']],
            ['Diclofenaco', 'Antiinflamatorio', 'Alivia dolor e inflamación.', ['Dolor gástrico', 'Mareo'], ['Anticoagulantes']],
            ['Cetirizina', 'Antihistamínico', 'Trata rinitis y urticaria.', ['Somnolencia', 'Fatiga'], ['Alcohol']],
            ['Azitromicina', 'Antibiótico', 'Trata infecciones respiratorias y de piel.', ['Diarrea', 'Dolor abdominal'], ['Antiácidos']],
            ['Ciprofloxacino', 'Antibiótico', 'Trata infecciones urinarias y digestivas.', ['Náuseas', 'Fotosensibilidad'], ['Leche', 'Antiácidos']],
            ['Tramadol', 'Analgésico', 'Alivia dolor moderado a intenso.', ['Mareo', 'Somnolencia'], ['Antidepresivos']],
            ['Warfarina', 'Anticoagulante', 'Previene la formación de coágulos.', ['Sangrado', 'Moretones'], ['Aspirina', 'Ibuprofeno']],
            ['Levotiroxina', 'Hormona tiroidea', 'Trata el hipotiroidismo.', ['Palpitaciones', 'Insomnio'], ['Calcio', 'Hierro']],
            ['Enalapril', 'Antihipertensivo', 'Controla la presión arterial.', ['Tos seca', 'Mareo'], ['Diuréticos ahorradores de potasio']],
            ['Sertralina', 'Antidepresivo', 'Trata depresión y ansiedad.', ['Náuseas', 'Insomnio'], ['Tramadol']],
            ['Montelukast', 'Antiasmático', 'Previene síntomas de asma y alergias.', ['Dolor de cabeza', 'Somnolencia'], ['Fenobarbital']],
            ['Hidroclorotiazida', 'Diurético', 'Ayuda a eliminar líquidos y controlar la presión.', ['Mareo', 'Deshidratación'], ['Litio']],
            ['Prednisona', 'Corticoesteroide', 'Reduce inflamación y reacciones alérgicas.', ['Aumento de apetito', 'Insomnio'], ['Antiinflamatorios no esteroideos']],
        ];

        foreach ($medicamentos as [$nombre, $tipo, $descripcion, $efectos, $interacciones]) {
            Medicamento::query()->updateOrCreate(
                ['nombre' => $nombre],
                [
                    'tipo' => $tipo,
                    'descripcion' => $descripcion,
                    'efectos_secundarios' => $efectos,
                    'interacciones' => $interacciones,
                ],
            );
        }

        $this->command?->info('Medicamentos de ejemplo creados: 20.');
    }
}
