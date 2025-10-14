<?php

namespace App\Http\Requests\MobileClinic;

use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\MobileEventStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MobileClinicRequest extends FormRequest
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
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => ['required', Rule::enum(MobileEventStatusEnum::class)],
            'rules' => 'required|array',
            'rules.*.specie' => ['required', Rule::in(AnimalSpeciesEnum::values())],
            'rules.*.gender' => ['required', Rule::in(GenderEnum::values())],
            'rules.*.max_registrations' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'rules.required' => 'Pelo menos uma regra é obrigatória.',
            'rules.*.specie.in' => 'A espécie selecionada é inválida.',
            'rules.*.gender.in' => 'O gênero selecionado é inválido.',
            'rules.*.max_registrations.min' => 'O número máximo de inscrições deve ser no mínimo 0.',
        ];
    }
}
