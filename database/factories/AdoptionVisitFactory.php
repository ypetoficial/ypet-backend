<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdoptionVisit>
 */
class AdoptionVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'citizen_id' => Citizen::first()?->id ?? Citizen::factory()->create(),
            'animal_id' => Animal::first()?->id ?? Animal::factory()->create(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'date_end' => $this->faker->dateTimeBetween('now', '+2 months'),
            'actions' => $this->faker->text(50),
        ];
    }
}
