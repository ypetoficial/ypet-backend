<?php

namespace App\Http\Requests\Product;

use App\Domains\Enums\ProductBaseUnitEnum;
use App\Domains\Enums\ProductCategoryEnum;
use App\Domains\Enums\ProductUnitEnum;
use App\Domains\Enums\TargetSpeciesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
        $baseUnits = implode(',', ProductBaseUnitEnum::values());
        $requiresSupplyParams = in_array($this->input('category'), ['medication', 'food']);

        return [
            'name' => ['required', 'string', 'min:2'],
            'category' => ['required', 'string', "in:$categories"],
            'manufacturer' => ['nullable', 'string'],
            'target_species' => ['nullable', 'string', "in:$species"],
            'unit' => ['nullable', 'string', "in:$units"],

            'stock' => ['required', 'integer', 'min:0'],
            'has_stock_control' => ['required', 'boolean'],
            'min_stock' => ['nullable', 'integer', 'min:0'],

            'expiration_date' => ['nullable', 'date'],
            'lot_number' => ['nullable', 'string'],

            'standard_quantity' => [Rule::requiredIf($requiresSupplyParams), 'numeric', 'min:0.01'],
            'reference_weight' => [Rule::requiredIf($requiresSupplyParams), 'numeric', 'min:0.01'],
            'standard_days' => [Rule::requiredIf($requiresSupplyParams), 'integer', 'min:1'],
            'base_unit' => ['nullable', 'string', "in:$baseUnits"],

            'observations' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ];
    }
}