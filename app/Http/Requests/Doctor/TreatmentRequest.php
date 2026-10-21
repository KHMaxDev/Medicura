<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TreatmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isDoctor();
    }

    public function rules(): array
    {
        return [
            'patient_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where('tipo', 'paciente'),
            ],
            'nombre_tratamiento' => ['required', 'string', 'max:160'],
            'descripcion' => ['required', 'string', 'max:2000'],
            'duracion' => ['required', 'integer', 'min:1', 'max:3650'],
            'dosis' => ['required', 'string', 'max:255'],
            'fecha_creacion' => ['required', 'date'],
        ];
    }
}
