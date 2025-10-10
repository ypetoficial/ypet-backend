<?php

namespace App\Http\Requests\User;

use App\Domains\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type' => ['sometimes', 'in:user,citizen,protector'],
            // Campos de usuário (sempre aceitos)
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
                function ($attribute, $value, $fail) {
                    if (! is_null($value) && ! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('E-mail inválido.');
                    }
                },
            ],
            'telephone' => ['sometimes', 'string', 'max:20'],
            'cellphone' => ['sometimes', 'string', 'max:20'],
            'document' => ['sometimes', 'string', 'min:11', 'max:11'],
            'onboarding_done' => ['sometimes', 'boolean'],
            'permissions' => ['sometimes', 'array'],
            'fcm_token' => ['sometimes', 'string', 'max:255'],
        ];

        $type = $this->input('type');

        if ($type === 'citizen') {
            $rules = array_merge($rules, [
                'birth_date' => ['sometimes', 'date'],
                'gender' => ['sometimes', 'string', 'max:20'],
                'special_permissions' => ['sometimes', 'boolean'],
                'can_report_abuse' => ['sometimes', 'boolean'],
                'can_mobile_castration' => ['sometimes', 'boolean'],
                'status' => ['sometimes', Rule::in(UserStatusEnum::values())],

                // Endereço (cidadão): lista de endereços
                'address' => ['sometimes', 'array'],
                'address.*.zip_code' => ['sometimes', 'string', 'max:10'],
                'address.*.street' => ['sometimes', 'string', 'max:255'],
                'address.*.number' => ['sometimes', 'string', 'max:20'],
                'address.*.complement' => ['sometimes', 'string', 'max:255'],
                'address.*.district' => ['sometimes', 'string', 'max:255'],
                'address.*.city' => ['sometimes', 'string', 'max:255'],
                'address.*.state' => ['sometimes', 'string', 'max:255'],
            ]);
        } elseif ($type === 'protector') {
            $rules = array_merge($rules, [
                'status' => ['sometimes', 'boolean'],
                'birth_date' => ['sometimes', 'date'],
                'gender' => ['sometimes', 'string', 'max:20'],
                'special_permissions' => ['sometimes', 'integer'],

                // Endereço (protetor): objeto único
                'address' => ['sometimes', 'array'],
                'address.type' => ['sometimes', 'integer'],
                'address.zipcode' => ['sometimes', 'string', 'max:10'],
                'address.street' => ['sometimes', 'string', 'max:255'],
                'address.number' => ['sometimes', 'string', 'max:20'],
                'address.complement' => ['sometimes', 'string', 'max:255'],
                'address.neighborhood' => ['sometimes', 'string', 'max:255'],
                'address.city' => ['sometimes', 'string', 'max:255'],
                'address.state' => ['sometimes', 'string', 'max:2'],
            ]);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.in' => 'O tipo deve ser um de: user, citizen, protector.',
            'name.sometimes' => 'O nome é opcional.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.sometimes' => 'O e-mail é opcional.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',
            'onboarding_done.boolean' => 'O onboarding_done deve ser um booleano.',
            'telephone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'cellphone.max' => 'O celular não pode ter mais de 20 caracteres.',
            'document.min' => 'O documento deve ter 11 caracteres.',
            'document.max' => 'O documento deve ter 11 caracteres.',
            'status.boolean' => 'O status deve ser um booleano.',
            'status.in' => 'O status informado é inválido.',
        ];
    }
}
