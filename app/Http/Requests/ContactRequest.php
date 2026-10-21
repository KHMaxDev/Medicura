<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'mensaje' => ['required', 'string', 'max:2000'],
        ];
    }
}
