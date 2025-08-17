<?php

namespace App\Http\Requests;

use App\Enums\LinkedTypeEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVetenirarianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'document' => 'required|string|max:14|unique:users',
            'crmv' => 'required|string|max:20|unique:veterinarians',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'linked_institution' => 'nullable|string|max:255',
            'linked_type' => ['nullable', Rule::enum(LinkedTypeEnum::class)],
            'observations' => 'nullable|string|max:255',
            'status' => ['required', 'string', Rule::enum(UserStatusEnum::class)],
            'permissions' => 'nullable|array',
            'permissions.*.can_access_castromovel' => 'nullable|boolean',
            'permissions.*.can_apply_vaccine' => 'nullable|boolean',
        ];
    }
}
