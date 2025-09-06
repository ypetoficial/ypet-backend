<?php

namespace App\Http\Requests\AnimalAmbulence;

use Illuminate\Validation\Rule;
use App\Enums\AnimalAmbulenceStatusEnum;
use App\Enums\AnimalAmbulencePriorityEnum;
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
            'priority' => ['required', Rule::enum(AnimalAmbulencePriorityEnum::class)],
            'status' => ['required', Rule::enum(AnimalAmbulenceStatusEnum::class)],
            'evidence' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'latitude'   => ['required','numeric','between:-90,90'],
            'longitude'  => ['required','numeric','between:-180,180'],
            'accuracy'   => ['nullable','numeric','min:0', 'max:100'],
            'altitude'   => ['nullable','numeric'],
            'heading'    => ['nullable','numeric'],
            'speed'      => ['nullable','numeric'],
            'timestamp'  => ['nullable','date']
        ];
    }

    public function messages(): array
    {
        return [
            'priority.required' => 'A prioridade é obrigatória.',
            'priority.enum' => 'A prioridade deve ser uma das opções disponíveis.',
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status deve ser uma das opções disponíveis.',
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
            'accuracy.numeric' => 'A precisão deve ser um número.',
            'accuracy.min' => 'A precisão deve ser maior ou igual a 0.',
            'accuracy.max' => 'A precisão deve ser menor ou igual a 100.',
            'altitude.numeric' => 'A altitude deve ser um número.',
            'heading.numeric' => 'A direção deve ser um número.',
            'speed.numeric' => 'A velocidade deve ser um número.',
            'timestamp.date' => 'A data deve ser uma data válida.',
        ];
    }
}
