<?php

namespace App\Http\Requests\Veterinarian;

use App\Enums\LinkedTypeEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVeterinarianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'document' => 'sometimes|required|string|max:14|unique:users',
            'crmv' => 'sometimes|required|string|max:20|unique:veterinarians',
            'email' => 'sometimes|required|string|email|max:255|unique:users',
            'password' => 'sometimes|required|string|min:8|confirmed',
            'phone' => 'sometimes|required|string|max:20',
            'linked_institution' => 'sometimes|required|string|max:255',
            'linked_type' => ['sometimes|required', Rule::enum(LinkedTypeEnum::class)],
            'observations' => 'sometimes|required|string|max:255',
            'status' => ['sometimes|required', 'string', Rule::enum(UserStatusEnum::class)],
            'permissions' => 'nullable|array',
            'permissions.*.can_access_castromovel' => 'nullable|boolean',
            'permissions.*.can_apply_vaccine' => 'nullable|boolean',
        ];
    }
}
