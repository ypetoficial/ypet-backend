<?php

namespace App\Http\Requests\Protector;

use App\Domains\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProtectorRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'document' => ['nullable', 'string', 'max:11', 'min:11'],
            'email' => ['nullable', 'email', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', Rule::in(UserStatusEnum::values())],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:20'],
            'special_permissions' => ['nullable', 'integer'],
            'address' => ['nullable', 'array'],
            'address.*.zipcode' => ['nullable', 'string', 'max:10'],
            'addresPs.*.street' => ['nullable', 'string', 'max:255'],
            'address.*.number' => ['nullable', 'string', 'max:20'],
            'address.*.complement' => ['nullable', 'string', 'max:255'],
            'address.*.neighborhood' => ['nullable', 'string', 'max:255'],
            'address.*.city' => ['nullable', 'string', 'max:255'],
            'address.*.state' => ['nullable', 'string', 'max:2'],
        ];
    }
}
