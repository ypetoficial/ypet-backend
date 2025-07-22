<?php

namespace App\Http\Requests\User;

use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|numeric|max:20',
            'role' => ['nullable', 'string', 'max:50', 'exists:roles,name'],
            'status' => ['nullable', Rule::in(UserStatusEnum::values())],
        ];
    }
}
