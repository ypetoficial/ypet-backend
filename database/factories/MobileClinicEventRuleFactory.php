<?php

namespace Database\Factories;

use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\GenderEnum;
use App\Models\MobileClinicEventRule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MobileClinicEventRuleFactory extends Factory
{
    protected $model = MobileClinicEventRule::class;

    public function definition(): array
    {
        return [
            'mobile_clinic_event_id' => fake()->randomNumber(),
            'specie' => fake()->randomElement(AnimalSpeciesEnum::values()),
            'gender' => fake()->randomElement(GenderEnum::values()),
            'max_registrations' => fake()->numberBetween(1, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
