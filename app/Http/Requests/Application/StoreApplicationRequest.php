<?php

namespace App\Http\Requests\Application;

use App\Domains\Enums\ProductCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => ['nullable', 'string', 'max:255'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'category' => ['required', 'string', Rule::in(ProductCategoryEnum::values())],
            'application_date' => ['required', 'date'],
            'animal_weight' => ['nullable', 'numeric', 'min:0'],
            'estimated_days_supply' => ['nullable', 'numeric', 'min:0'],
            'responsible_user_id' => ['nullable', 'integer', 'exists:users,id'],
            'lot_number' => ['nullable', 'string', 'max:255'],
            'expiration_date' => ['nullable', 'date'],
            'supplement_type' => ['nullable', 'string', 'max:255'],
            'via_administration' => ['nullable', 'string', 'max:255'],
            'next_dose_date' => ['nullable', 'date'],
            'frequency' => ['nullable', 'string', 'max:255'],
            'period_days' => ['nullable', 'integer', 'min:1'],
            'dosage_observations' => ['nullable', 'string'],
            'daily_quantity_g_per_kg' => ['nullable', 'numeric', 'min:0'],
            'meals_per_day' => ['nullable', 'integer', 'min:1'],
            'observations' => ['nullable', 'string'],
        ];
    }
}
