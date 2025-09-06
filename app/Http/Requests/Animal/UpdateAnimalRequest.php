<?php

namespace App\Http\Requests\Animal;

use App\Enums\AnimalCoatEnum;
use App\Enums\AnimalSpeciesEnum;
use App\Enums\AnimalStatusEnum;
use App\Enums\GenderEnum;
use App\Enums\SizeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnimalRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'species' => ['sometimes', 'string', 'max:255', Rule::in(AnimalSpeciesEnum::values())],
            'gender' => ['sometimes', 'string', 'max:255', Rule::in(GenderEnum::values())],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
            'size' => ['sometimes', 'string', Rule::in(SizeEnum::values())],
            'color' => ['nullable', 'string', 'max:255'],
            'coat' => ['nullable', 'string', Rule::in(AnimalCoatEnum::values())],
            'characteristics' => ['nullable', 'string', 'max:1000'],
            'surname' => ['nullable', 'string', 'max:255'],
            'tutor_id' => ['nullable', 'exists:users,id'],
            'entry_date' => ['nullable', 'date', 'before_or_equal:today'],
            'status' => ['sometimes', 'string', 'max:255', Rule::in(AnimalStatusEnum::values())],
            'microchip_number' => [
                'sometimes',
                'numeric',
                Rule::unique('animal_entry_datas', 'microchip_number')->ignore($this->animal),
            ],
            'registration_number' => [
                'nullable',
                'numeric',
                Rule::unique('animal_entry_datas', 'registration_number')->ignore($this->animal),
            ],
            'castrated' => ['sometimes', 'boolean'],
            'dewormed' => ['sometimes', 'boolean'],
            'infirmity' => ['nullable', 'string', 'max:255'],
            'castration_site' => ['nullable', 'string', 'max:255'],
            'collection_site' => ['nullable', 'string', 'max:255'],
            'collection_reason' => ['nullable', 'string', 'max:255'],
        ];
    }
}
