<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:160'],
            'direccion.estado' => ['required', 'string', 'max:100'],
            'direccion.municipio' => ['required', 'string', 'max:100'],
            'direccion.ciudad' => ['required', 'string', 'max:100'],
            'direccion.colonia' => ['required', 'string', 'max:120'],
            'direccion.codigo_postal' => ['required', 'digits:5'],
            'direccion.calle' => ['required', 'string', 'max:160'],
            'direccion.numero' => ['required', 'string', 'max:20'],
        ];
    }
}
