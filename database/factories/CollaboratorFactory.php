<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborator>
 */
class CollaboratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'cnpj' => fake()->unique()->numerify('##############'),
            'work_started_at' => now(),
            'work_ended_at' => null,
            'observations' => fake()->sentence(),
        ];
    }
}
