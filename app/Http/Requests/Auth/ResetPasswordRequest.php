<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
