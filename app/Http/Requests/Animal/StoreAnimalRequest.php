<?php

namespace App\Http\Requests\Animal;

use App\Enums\AnimalCoatEnum;
use App\Enums\SizeEnum;
use App\Enums\AnimalSpeciesEnum;
use App\Enums\AnimalStatusEnum;
use App\Enums\GenderEnum;
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
            'picture' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:255', Rule::in(AnimalSpeciesEnum::values())],
            'gender' => ['required', 'string', 'max:255', Rule::in(GenderEnum::values())],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
            'castrated' => ['required', 'boolean'],
            'size' => ['required', 'string', Rule::in(SizeEnum::values())],
            'color' => ['nullable', 'string', 'max:255'],
            'coat' => ['nullable', 'string', Rule::in(AnimalCoatEnum::values())],
            'characteristics' => ['nullable', 'string', 'max:1000'],
            'surname' => ['nullable', 'string', 'max:255'],
            'tutor_id' => ['nullable', 'exists:users,id'],
            'entry_date' => ['nullable', 'date', 'before_or_equal:today'],
            'status' => ['required', 'string', 'max:255', Rule::in(AnimalStatusEnum::values())],
            'castration_site' => ['nullable', 'string', 'max:255'],
            'collection_site' => ['nullable', 'string', 'max:255'],
            'collection_reason' => ['nullable', 'string', 'max:255'],
            'microchip_number' => ['required', 'numeric', 'unique:animals,microchip_number'],
            'registration_number' => ['nullable', 'numeric', 'unique:animals,registration_number'],
        ];
    }
}
