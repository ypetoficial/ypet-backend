<?php

namespace App\Http\Requests\Application;

use App\Domains\Enums\ProductCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => ['sometimes', 'string', 'max:255'],
            'animal_id' => ['sometimes', 'integer', 'exists:animals,id'],
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'category' => ['required', 'string', Rule::in(ProductCategoryEnum::values())],
            'application_date' => ['sometimes', 'date'],
            'animal_weight' => ['sometimes', 'numeric', 'min:0'],
            'estimated_days_supply' => ['sometimes', 'numeric', 'min:0'],
            'responsible_user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'lot_number' => ['sometimes', 'string', 'max:255'],
            'expiration_date' => ['sometimes', 'date'],
            'supplement_type' => ['sometimes', 'string', 'max:255'],
            'via_administration' => ['sometimes', 'string', 'max:255'],
            'next_dose_date' => ['sometimes', 'date'],
            'frequency' => ['sometimes', 'string', 'max:255'],
            'period_days' => ['sometimes', 'integer', 'min:1'],
            'dosage_observations' => ['sometimes', 'string'],
            'daily_quantity_g_per_kg' => ['sometimes', 'numeric', 'min:0'],
            'meals_per_day' => ['sometimes', 'integer', 'min:1'],
            'observations' => ['sometimes', 'string'],
        ];
    }
}
