<?php

namespace App\Http\Requests\Product;

use App\Domains\Enums\ProductCategoryEnum;
use App\Domains\Enums\ProductSupplementTypeEnum;
use App\Domains\Enums\ProductUnitEnum;
use App\Domains\Enums\TargetSpeciesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categories = implode(',', ProductCategoryEnum::values());
        $species = implode(',', TargetSpeciesEnum::values());
        $units = implode(',', ProductUnitEnum::values());
        $requiresSupplyParams = in_array($this->input('category'), ['medication', 'food']);
        $requiresSupplementType = $this->input('category') === 'supplement';

        return [
            'name' => ['sometimes', 'required', 'string', 'min:2'],
            'category' => ['sometimes', 'required', 'string', "in:$categories"],
            'supplement_type' => [Rule::requiredIf($requiresSupplementType), 'nullable', 'string', Rule::in(ProductSupplementTypeEnum::values())],
            'manufacturer' => ['nullable', 'string'],
            'target_species' => ['nullable', 'string', "in:$species"],
            'unit' => ['nullable', 'string', "in:$units"],

            'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'has_stock_control' => ['nullable', 'boolean'],
            'min_stock' => ['nullable', 'integer', 'min:0'],

            'expiration_date' => ['nullable', 'date'],
            'lot_number' => ['nullable', 'string'],

            'standard_quantity' => [Rule::requiredIf($requiresSupplyParams), 'numeric', 'min:0.01'],
            'reference_weight' => [Rule::requiredIf($requiresSupplyParams), 'numeric', 'min:0.01'],
            'standard_days' => [Rule::requiredIf($requiresSupplyParams), 'integer', 'min:1'],
            'base_unit' => ['nullable', 'string', "in:$units"],

            'observations' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ];
    }
}
