<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) ($this->user()?->isAdmin() || $this->user()?->isDoctor());
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:160'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
            'tipo' => ['required', 'string', 'max:100'],
            'efectos_secundarios' => ['nullable', 'array'],
            'efectos_secundarios.*' => ['nullable', 'string', 'max:255'],
            'interacciones' => ['nullable', 'array'],
            'interacciones.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'efectos_secundarios' => $this->cleanList('efectos_secundarios'),
            'interacciones' => $this->cleanList('interacciones'),
        ]);
    }

    private function cleanList(string $key): array
    {
        $values = $this->input($key, []);

        if (! is_array($values)) {
            return [];
        }

        return array_values(array_filter(array_map(
            fn ($value) => is_string($value) ? trim($value) : '',
            $values,
        )));
    }
}
