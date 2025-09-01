<?php

namespace App\Http\Requests\Citizen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCitizenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'document' => [
                'nullable',
                'string',
                'max:11',
                'min:11',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:citizens,email'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'address' => [
                'nullable',
                'min:8',
                'max:20',
            ],
            'tenant_id' => [
                'nullable', 
                'integer', 
                'exists:tenants,id'
            ],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:20'],
            'special_permissions' => ['nullable','boolean'],
            'can_report_abuse' => ['nullable','boolean'],
            'can_mobile_castration' => ['nullable','boolean'],
            'status' => ['nullable', 'integer'],
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
