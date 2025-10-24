<?php

namespace App\Http\Requests\Animal;

use App\Domains\Enums\AnimalCoatEnum;
use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\AnimalStatusEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\SizeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnimalRequest extends FormRequest
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
            // Dados do animal
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:255', Rule::in(AnimalSpeciesEnum::values())],
            'gender' => ['required', 'string', 'max:255', Rule::in(GenderEnum::values())],
            'size' => ['nullable', 'string', Rule::in(SizeEnum::values())],
            'weight' => ['required', 'numeric', 'min:0'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'color' => ['nullable', 'string', 'max:255'],
            'coat' => ['nullable', 'string', Rule::in(AnimalCoatEnum::values())],
            'characteristics' => ['nullable', 'string', 'max:1000'],
            'surname' => ['nullable', 'string', 'max:255'],
            'tutor_id' => ['nullable', 'exists:users,id'],
            'picture' => ['nullable', 'image', 'max:2048'],
            'location_id' => ['nullable', 'exists:locations,id'],

            // Dados de entrada
            'status' => ['required', 'string', 'max:255', Rule::in(AnimalStatusEnum::values())],
            'microchip_number' => ['required', 'numeric', 'unique:animal_entry_datas,microchip_number'],
            'registration_number' => ['nullable', 'numeric', 'unique:animal_entry_datas,registration_number'],
            'castrated' => ['required', 'boolean'],
            'dewormed' => ['required', 'boolean'],
            'infirmity' => ['nullable', 'string', 'max:255'],
            'entry_date' => ['nullable', 'date', 'before_or_equal:today'],
            'castration_site' => ['nullable', 'string', 'max:255'],
            'collection_site' => ['nullable', 'string', 'max:255'],
            'collection_reason' => ['nullable', 'string', 'max:255'],
        ];
    }
}
