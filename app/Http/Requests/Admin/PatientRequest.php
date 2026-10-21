<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        $patient = $this->route('patient');
        $id = $patient?->getKey();

        return [
            'nombre' => ['required', 'string', 'max:120'],
            'apellido_paterno' => ['required', 'string', 'max:120'],
            'apellido_materno' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'celular' => ['nullable', 'digits:10'],
            'fecha_nacimiento' => ['nullable', 'date', 'before_or_equal:today'],
            'genero' => ['nullable', Rule::in(['Masculino', 'Femenino', 'No especifica'])],
            'curp' => ['required', 'string', 'size:18', Rule::unique('users', 'curp')->ignore($id)],
            'contrasena' => [$patient ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'contrasena' => 'contraseña',
        ];
    }
}
