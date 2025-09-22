<?php

namespace App\Http\Requests\AdoptionVisit;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdoptionVisitRequest extends FormRequest
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
            'citizen_id' => ['required', 'integer', 'exists:citizens,id'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'start_date' => ['required', 'date'],
            'date_end' => ['required', 'date'],
            'status' => ['required', 'integer'],
            'actions' => ['required', 'integer'],
        ];
    }
}
