<?php

namespace App\Http\Requests\Vaccine;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:vaccines,name'],
            'type' => ['required', 'string', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:500'],
            'target_specie' => ['nullable', 'in:Dog,Cat,Both'],
            'dose_count' => ['required', 'integer', 'min:1'],
            'dose_interval' => ['required', 'integer', 'min:0'],
            'manu_facturer' => ['nullable', 'string', 'max:255'],
            'expiration_date' => ['required', 'date', 'after_or_equal:today'],
            'batch' => ['required', 'string', 'max:255', 'unique:vaccines,batch'],
        ];
    }
}
