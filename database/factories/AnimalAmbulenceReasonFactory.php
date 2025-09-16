<?php

namespace Database\Factories;

use App\Domains\Enums\AnimalAmbulencePriorityEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnimalAmbulenceReason>
 */
class AnimalAmbulenceReasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'priority' => fake()->randomElement(AnimalAmbulencePriorityEnum::cases()),
            'color' => fake()->hexColor(),
            'description' => fake()->text(),
        ];
    }
}
