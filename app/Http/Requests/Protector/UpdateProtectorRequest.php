<?php

namespace App\Http\Requests\Protector;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => ['nullable', 'email', 'max:255', 'unique:citizens,email'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'status' => ['nullable', 'boolean'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:20'],
            'special_permissions' => ['nullable', 'integer'],
            'address' => ['nullable', 'array'],
            'address.type' => ['nullable', 'integer'],
            'address.zipcode' => ['nullable', 'string', 'max:10'],
            'address.street' => ['nullable', 'string', 'max:255'],
            'address.number' => ['nullable', 'string', 'max:20'],
            'address.complement' => ['nullable', 'string', 'max:255'],
            'address.neighborhood' => ['nullable', 'string', 'max:255'],
            'address.city' => ['nullable', 'string', 'max:255'],
            'address.state' => ['nullable', 'string', 'max:2'],
        ];
    }
}
