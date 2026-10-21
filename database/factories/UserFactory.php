<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido_paterno' => fake()->lastName(),
            'apellido_materno' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'contrasena' => static::$password ??= Hash::make('password'),
            'tipo' => User::TYPE_PATIENT,
            'estatus' => User::STATUS_ACTIVE,
            'celular' => fake()->numerify('##########'),
            'fecha_nacimiento' => fake()->dateTimeBetween('-80 years', '-18 years'),
            'genero' => fake()->randomElement(['Masculino', 'Femenino', 'No especifica']),
            'curp' => Str::upper(fake()->unique()->bothify('????######??????##')),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'tipo' => User::TYPE_ADMIN,
            'estatus' => User::STATUS_ACTIVE,
            'curp' => null,
        ]);
    }

    public function doctor(): static
    {
        return $this->state(fn () => [
            'tipo' => User::TYPE_DOCTOR,
            'estatus' => User::STATUS_ACTIVE,
            'cedula' => fake()->unique()->numerify('#########'),
            'especialidad' => fake()->randomElement(['Medicina general', 'Pediatría', 'Cardiología', 'Dermatología']),
            'institucion' => 'Medicura',
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'estatus' => User::STATUS_PENDING,
        ]);
    }
}
