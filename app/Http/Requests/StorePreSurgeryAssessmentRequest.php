<?php

namespace App\Http\Requests;

use App\Domains\Enums\AbdominalPalpationEnum;
use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\HydrationEnum;
use App\Domains\Enums\MucosaEnum;
use App\Domains\Enums\PalpationOfLymphNodesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePreSurgeryAssessmentRequest extends FormRequest
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
            'animal_id' => 'required|exists:animals,id',
            'mucosa' => ['required', Rule::enum(MucosaEnum::class)],
            'hydration' => ['required', Rule::enum(HydrationEnum::class)],
            'adequate_fasting' => 'required|boolean',
            'fasting_time' => 'nullable|integer',
            'escore_corporal' => 'required|integer',
            'heart_rate' => 'required|integer',
            'respiratory_rate' => 'required|integer',
            'abdominal_palpation' => ['required', Rule::enum(AbdominalPalpationEnum::class)],
            'abdominal_palpation_description' => 'nullable|string',
            'palpation_of_lymph_nodes' => ['required', Rule::enum(PalpationOfLymphNodesEnum::class)],
            'palpation_of_lymph_nodes_description' => 'nullable|string',
            'vulvar_discharge' => 'required|boolean',
            'foreskin_discharge' => 'required|boolean',
            'ectopic_testicle' => 'required|boolean',
            'obervations' => 'nullable|string',
            'transsurgical_intercurrences' => 'nullable|string',
            'measures_taken' => 'nullable|string',
            'animal_data' => 'nullable|array',
            'animal_data.name' => 'nullable|string',
            'animal_data.species' => ['nullable', Rule::enum(AnimalSpeciesEnum::class)],
            'animal_data.gender' => ['nullable', Rule::enum(GenderEnum::class)],
            'animal_data.weight' => 'nullable|numeric',
            'animal_data.birth_date' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'animal_id.required' => 'O animal é obrigatório.',
            'animal_id.exists' => 'O animal não existe.',
            'mucosa.required' => 'A mucosa é obrigatória.',
            'hydration.required' => 'A hidratação é obrigatória.',
            'adequate_fasting.required' => 'O fasting é obrigatório.',
            'fasting_time.required' => 'O tempo de fasting é obrigatório.',
            'escore_corporal.required' => 'O escore corporal é obrigatório.',
            'heart_rate.required' => 'A taxa cardíaca é obrigatória.',
            'respiratory_rate.required' => 'A taxa respiratória é obrigatória.',
            'abdominal_palpation.required' => 'A palpada abdominal é obrigatória.',
            'abdominal_palpation_description.required' => 'A descrição da palpada abdominal é obrigatória.',
            'palpation_of_lymph_nodes.required' => 'A palpada de linfócitos é obrigatória.',
            'palpation_of_lymph_nodes_description.required' => 'A descrição da palpada de linfócitos é obrigatória.',
            'vulvar_discharge.required' => 'A discação vulvar é obrigatória.',
            'foreskin_discharge.required' => 'A discação da pele é obrigatória.',
            'ectopic_testicle.required' => 'O testículo ectópico é obrigatório.',
            'obervations.required' => 'A observação é obrigatória.',
            'transsurgical_intercurrences.required' => 'A intercorrência transsurgical é obrigatória.',
            'measures_taken.required' => 'A medida tomada é obrigatória.',
        ];
    }
}
