<?php

namespace App\Http\Requests\LostAnimal;

use App\Domains\Enums\LostAnimalStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLostAnimalRequest extends FormRequest
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
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'lost_at' => ['required', 'date'],
            'status' => ['required', 'string', Rule::in(LostAnimalStatusEnum::values())],
            'address.street' => ['required', 'string'],
            'address.number' => ['required', 'string'],
            'address.complement' => ['nullable', 'string'],
            'address.district' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string'],
            'address.zip_code' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.latitude' => ['nullable', 'numeric'],
            'address.longitude' => ['nullable', 'numeric'],
        ];
    }
}
