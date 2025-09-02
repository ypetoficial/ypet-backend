<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

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
            'animal_id' => 'required|exists:animals,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'mobile_clinic_event_id.required' => 'O campo Evento é obrigatório.',
            'animal_id.required' => 'O campo Animal é obrigatório.',
            'user_id.required' => 'O campo Usuário é obrigatório.',
        ];
    }
}
