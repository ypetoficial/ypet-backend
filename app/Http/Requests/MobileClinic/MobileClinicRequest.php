<?php

namespace App\Http\Requests\MobileClinic;

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
            'species' => 'nullable|string|max:255',
            'gender' => ['nullable', Rule::enum(GenderEnum::class)],
            'max_registrations' => 'required|integer|min:1',
        ];
    }
}
