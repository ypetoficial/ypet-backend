<?php

namespace App\Http\Requests\User;

use App\Domains\Enums\RolesEnum;
use App\Domains\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'telephone' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'roles' => ['required', 'array'],
            'roles.*' => ['string', 'max:50', Rule::in(RolesEnum::values()), 'exists:roles,name'],
            'status' => ['required', Rule::in(UserStatusEnum::values())],
        ];
    }
}
