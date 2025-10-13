<?php

namespace App\Http\Requests\Protector;

use App\Domains\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProtectorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:11', 'min:11'],
            'email' => ['required', 'email', 'max:255'],
            'password' => 'required|string|min:8|confirmed',
            'telephone' => ['required', 'string', 'max:20'],
            'status' => ['required', Rule::in(UserStatusEnum::values())],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:20'],
            'special_permissions' => ['required', 'integer'],
            'fcm_token' => ['nullable', 'string', 'max:255'],
            'address' => ['array'],
            'address.*.zip_code' => ['required', 'string', 'max:10'],
            'address.*.street' => ['required', 'string', 'max:255'],
            'address.*.number' => ['required', 'string', 'max:20'],
            'address.*.complement' => ['nullable', 'string', 'max:255'],
            'address.*.neighborhood' => ['sometimes', 'string', 'max:255'],
            'address.*.city' => ['required', 'string', 'max:255'],
            'address.*.state' => ['required', 'string', 'max:2'],
        ];
    }
}
