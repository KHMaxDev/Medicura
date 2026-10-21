<?php

namespace Database\Seeders;

use App\Models\Institucion;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $ciudades = [
            'Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Querétaro',
            'Mérida', 'Tijuana', 'León', 'Toluca', 'Veracruz',
        ];

        foreach ($ciudades as $index => $ciudad) {
            foreach (['Hospital General', 'Centro de Salud'] as $tipo) {
                $nombre = $tipo.' de '.$ciudad;

                Institucion::query()->updateOrCreate(
                    ['nombre' => $nombre],
                    [
                        'direccion' => [
                            'estado' => $this->estado($ciudad),
                            'municipio' => $ciudad,
                            'ciudad' => $ciudad,
                            'colonia' => 'Centro',
                            'codigo_postal' => str_pad((string) (10000 + ($index * 2) + ($tipo === 'Centro de Salud' ? 1 : 0)), 5, '0', STR_PAD_LEFT),
                            'calle' => 'Avenida de la Salud',
                            'numero' => (string) (100 + $index),
                        ],
                    ],
                );
            }
        }

        $this->command?->info('Instituciones de ejemplo creadas: 20.');
    }

    private function estado(string $ciudad): string
    {
        return match ($ciudad) {
            'Guadalajara' => 'Jalisco',
            'Monterrey' => 'Nuevo León',
            'Puebla' => 'Puebla',
            'Querétaro' => 'Querétaro',
            'Mérida' => 'Yucatán',
            'Tijuana' => 'Baja California',
            'León' => 'Guanajuato',
            'Toluca' => 'Estado de México',
            'Veracruz' => 'Veracruz',
            default => 'Ciudad de México',
        };
    }
}
