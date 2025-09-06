<?php

namespace App\Http\Requests\AnimalAmbulence;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalAmbulenceRequest extends FormRequest
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
            'reason_id' => ['required', Rule::exists('animal_ambulence_reasons', 'id')],
            'evidence' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'latitude'   => ['required','numeric','between:-90,90'],
            'longitude'  => ['required','numeric','between:-180,180']
        ];
    }

    public function messages(): array
    {
        return [
            'reason_id.required' => 'A razão é obrigatória.',
            'reason_id.exists' => 'A razão deve existir.',
            'evidence.required' => 'A evidência é obrigatória.',
            'evidence.file' => 'A evidência deve ser um arquivo.',
            'evidence.mimes' => 'A evidência deve ser uma imagem.',
            'evidence.max' => 'A evidência deve ter no máximo 2MB.',
            'latitude.required' => 'A latitude é obrigatória.',
            'latitude.numeric' => 'A latitude deve ser um número.',
            'latitude.between' => 'A latitude deve estar entre -90 e 90.',
            'longitude.required' => 'A longitude é obrigatória.',
            'longitude.numeric' => 'A longitude deve ser um número.',
            'longitude.between' => 'A longitude deve estar entre -180 e 180.',
        ];
    }
}
