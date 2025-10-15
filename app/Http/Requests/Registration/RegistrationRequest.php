<?php

namespace App\Http\Requests\Registration;

use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\AnimalStatusEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\SizeEnum;
use App\Domains\Enums\UFEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
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
            'mobile_clinic_event_id' => 'required|exists:mobile_clinic_events,id',
            'scheduler_at' => 'required|date',

            'tutor_id' => 'nullable|exists:users,id',
            'tutor_name' => ['required_if:tutor_id,null', 'string', 'max:255'],
            'tutor_document' => ['required_if:tutor_id,null', 'string', 'max:14'],
            'tutor_cellphone' => ['required_if:tutor_id,null', 'string', 'max:20'],
            'tutor_email' => ['required_if:tutor_id,null', 'email', 'max:255'],
            'tutor_address' => ['required_if:tutor_id,null', 'array'],
            'tutor_address.street' => ['required_if:tutor_id,null', 'string', 'max:255'],
            'tutor_address.number' => ['required_if:tutor_id,null', 'string', 'max:20'],
            'tutor_address.complement' => ['nullable', 'string', 'max:255'],
            'tutor_address.district' => ['nullable', 'string', 'max:255'],
            'tutor_address.city' => ['required_if:tutor_id,null', 'string', 'max:255'],
            'tutor_address.state' => ['nullable', Rule::in(UFEnum::values())],
            'tutor_address.zip_code' => ['nullable', 'string', 'max:10'],

            'animal_id' => 'nullable|exists:animals,id',
            'animal_name' => ['required_if:animal_id,null', 'string', 'max:255'],
            'animal_specie' => ['required_if:animal_id,null', Rule::in(AnimalSpeciesEnum::values())],
            'animal_gender' => ['required_if:animal_id,null', Rule::in(GenderEnum::values())],
            'animal_size' => ['required_if:animal_id,null', Rule::in(SizeEnum::values())],
            'animal_status' => ['required_if:animal_id,null', Rule::in(AnimalStatusEnum::values())],
            'animal_color' => ['nullable', 'string', 'max:100'],
            'animal_birth_date' => ['nullable', 'date'],
            'animal_weight' => ['required_if:animal_id,null', 'numeric', 'min:0', 'max:999.99'],
        ];
    }

    public function messages(): array
    {
        return [
            'mobile_clinic_event_id.required' => 'O campo Evento é obrigatório.',
            'animal_id.required' => 'O campo Animal é obrigatório.',
            'tutor_id.required' => 'O campo Usuário é obrigatório.',
            'tutor_name.required_if' => 'O campo Nome do Tutor é obrigatório quando o Tutor não está selecionado.',
            'tutor_cpf.required_if' => 'O campo CPF do Tutor é obrigatório quando o Tutor não está selecionado.',
            'tutor_phone.required_if' => 'O campo Telefone do Tutor é obrigatório quando o Tutor não está selecionado.',
            'animal_name.required_if' => 'O campo Nome do Animal é obrigatório quando o Animal não está selecionado.',
            'animal_specie.required_if' => 'O campo Espécie do Animal é obrigatório quando o Animal não está selecionado.',
            'animal_birth_date.date' => 'O campo Data de Nascimento do Animal deve ser uma data válida.',
        ];
    }
}
