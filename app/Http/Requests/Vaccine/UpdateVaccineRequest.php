<?php

namespace App\Http\Requests\Vaccine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVaccineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', 'unique:vaccines,name'],
            'type' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive'],
            'purpose' => ['nullable', 'string', 'max:500'],
            'target_specie' => ['nullable', 'in:Dog,Cat,Both'],
            'dose_count' => ['nullable', 'integer', 'min:1'],
            'dose_interval' => ['nullable', 'integer', 'min:0'],
            'manu_facturer' => ['nullable', 'string', 'max:255'],
            'expiration_date' => ['nullable', 'date', 'after_or_equal:today'],
            'batch' => ['nullable', 'string', 'max:255', 'unique:vaccines,batch'],
        ];
    }
}
