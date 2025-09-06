<?php

namespace App\Http\Requests\AnimalAmbulence;

use Illuminate\Validation\Rule;
use App\Enums\AnimalAmbulenceStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalAmbulenceRequest extends FormRequest
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
           'status' => ['required', Rule::enum(AnimalAmbulenceStatusEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status deve ser uma das opções disponíveis.',
        ];
    }
}
