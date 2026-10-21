<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('tipo', 'doctor')->where('estatus', 'activo'),
            ],
            'patient_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('tipo', 'paciente'),
            ],
            'fecha' => ['required', 'date'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'razon' => ['required', 'string', 'max:1000'],
            'acciones' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
