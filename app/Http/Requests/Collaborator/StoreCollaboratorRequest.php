<?php

namespace App\Http\Requests\Collaborator;

use App\Domains\Enums\BankAccountPixTypeEnum;
use App\Domains\Enums\BankAccountTypeEnum;
use App\Domains\Enums\CollaboratorRoleEnum;
use App\Domains\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class StoreCollaboratorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cnpj' => ['nullable', 'string', 'max:20', 'unique:collaborators,cnpj'],
            'work_started_at' => ['required', 'date'],
            'work_ended_at' => ['nullable', 'date', 'after_or_equal:work_started_at'],
            'observations' => ['nullable', 'string'],

            'user_email' => ['required', 'email'],
            'user_name' => ['required', 'string', 'max:255'],
            'user_password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_document' => ['nullable', 'string', 'max:20', 'unique:users,document'],
            'user_cellphone' => ['nullable', 'string', 'max:20'],
            'user_status' => ['required', Rule::in(UserStatusEnum::values())],
            'user_role' => ['required', Rule::in(CollaboratorRoleEnum::values())],

            'bank_account_type' => ['nullable', Rule::in(BankAccountTypeEnum::values())],
            'bank_account_bank_code' => [$this->requiredIfCurrentAccountRule(), 'nullable', 'string', 'max:10'],
            'bank_account_bank_name' => [$this->requiredIfCurrentAccountRule(), 'nullable', 'string', 'max:255'],
            'bank_account_agency' => [$this->requiredIfCurrentAccountRule(), 'nullable', 'string', 'max:20'],
            'bank_account_number' => [$this->requiredIfCurrentAccountRule(), 'nullable', 'string', 'max:20'],
            'bank_account_holder_name' => [$this->requiredIfCurrentAccountRule(), 'nullable', 'string', 'max:255'],
            'bank_account_holder_document' => [$this->requiredIfCurrentAccountRule(), 'nullable', 'string', 'max:20'],
            'bank_account_pix_key' => [$this->requiredIfPixAccountRule(), 'nullable', 'string', 'max:255'],
            'bank_account_pix_key_type' => [
                $this->requiredIfPixAccountRule(),
                'nullable',
                Rule::in(BankAccountPixTypeEnum::values()),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        $typesAccount = Arr::map(BankAccountTypeEnum::labels(), fn ($item) => data_get($item, 'label', '').' ('.data_get($item, 'value', '').')');
        $typesPix = Arr::map(BankAccountPixTypeEnum::labels(), fn ($item) => data_get($item, 'label', '').' ('.data_get($item, 'value', '').')');
        $typesRole = Arr::map(CollaboratorRoleEnum::labels(), fn ($item) => data_get($item, 'label', '').' ('.data_get($item, 'value', '').')');
        $typesUserStatus = Arr::map(UserStatusEnum::labels(), fn ($item) => data_get($item, 'label', '').' ('.data_get($item, 'value', '').')');

        return [
            'work_ended_at.after_or_equal' => 'A data de término do trabalho deve ser igual ou posterior à data de início.',
            'user_password.confirmed' => 'A confirmação da senha do usuário não corresponde.',
            'bank_account_type.in' => 'O tipo de conta bancária selecionado é inválido. Tipos válidos: '.implode(', ', $typesAccount).'.',
            'bank_account_type.required' => 'O tipo de conta bancária é obrigatório. Tipos válidos: '.implode(', ', $typesAccount).'.',
            'bank_account_pix_key_type.in' => 'O tipo de chave Pix selecionado é inválido. Tipos válidos: '.implode(', ', $typesPix).'.',
            'bank_account_pix_key_type.required' => 'O tipo de chave Pix é obrigatório. Tipos válidos: '.implode(', ', $typesPix).'.',
            'user_role.in' => 'O papel selecionado é inválido. Papéis válidos: '.implode(', ', $typesRole).'.',
            'user_role.required' => 'O papel é obrigatório. Papéis válidos: '.implode(', ', $typesRole).'.',
            'user_status.in' => 'O status do usuário selecionado é inválido. Status válidos: '.implode(', ', $typesUserStatus).'.',
            'user_status.required' => 'O status do usuário é obrigatório. Status válidos: '.implode(', ', $typesUserStatus).'.',
        ];
    }

    private function requiredIfCurrentAccountRule(): RequiredIf
    {
        return Rule::requiredIf(
            fn () => in_array(
                $this->input('bank_account_type'),
                [BankAccountTypeEnum::CURRENT_ACCOUNT->value]
            )
        );
    }

    private function requiredIfPixAccountRule(): RequiredIf
    {
        return Rule::requiredIf(
            fn () => in_array(
                $this->input('bank_account_type'),
                [BankAccountTypeEnum::PIX_ACCOUNT->value]
            )
        );
    }
}
