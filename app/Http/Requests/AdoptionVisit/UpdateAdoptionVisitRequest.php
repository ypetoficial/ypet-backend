<?php

namespace App\Http\Requests\AdoptionVisit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdoptionVisitRequest extends FormRequest
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
            'citizen_id' => ['nullable', 'integer', 'exists:citizens,id'],
            'animal_id' => ['nullable', 'integer', 'exists:animals,id'],
            'start_date' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date'],
            'status' => ['nullable', 'integer'],
            'actions' => ['nullable', 'integer'],
        ];
    }
}
