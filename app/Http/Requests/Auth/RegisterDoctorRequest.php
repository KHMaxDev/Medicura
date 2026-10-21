<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:120'],
            'apellido_paterno' => ['required', 'string', 'max:120'],
            'apellido_materno' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'celular' => ['required', 'digits:10'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:today', 'after:1900-01-01'],
            'genero' => ['required', Rule::in(['Masculino', 'Femenino', 'No especifica'])],
            'curp' => ['required', 'string', 'size:18', Rule::unique('users', 'curp')],
            'cedula' => ['required', 'string', 'max:40', Rule::unique('users', 'cedula')],
            'especialidad' => ['required', 'string', 'max:120'],
            'institucion' => ['required', 'string', 'max:160'],
            'contrasena' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'contrasena' => 'contraseña',
        ];
    }
}
