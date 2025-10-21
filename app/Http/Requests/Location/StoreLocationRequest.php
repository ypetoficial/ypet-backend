<?php

namespace App\Http\Requests\Location;

use App\Domains\Enums\LocationStatusEnum;
use App\Domains\Enums\LocationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location_name' => ['required', 'string', 'max:255'],
            'location_type' => ['required', new Enum(LocationTypeEnum::class)],
            'responsible_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer'],
            'email' => ['nullable', 'email', 'unique:locations,email'],
            'address' => ['nullable', 'array'],
            'address.*.zipcode' => ['nullable', 'string', 'max:10'],
            'addresPs.*.street' => ['nullable', 'string', 'max:255'],
            'address.*.number' => ['nullable', 'string', 'max:20'],
            'address.*.complement' => ['nullable', 'string', 'max:255'],
            'address.*.neighborhood' => ['nullable', 'string', 'max:255'],
            'address.*.city' => ['nullable', 'string', 'max:255'],
            'address.*.state' => ['nullable', 'string', 'max:2'],
            'cnpj' => ['nullable', 'max:20'],
            'bank_account_or_pix' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in([LocationStatusEnum::INACTIVE->value, LocationStatusEnum::ACTIVE->value])],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
