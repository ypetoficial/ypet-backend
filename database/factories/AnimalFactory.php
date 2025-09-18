<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hash' => $this->faker->uuid(),
            'tutor_id' => $this->faker->randomNumber(),
            'name' => $this->faker->firstName(),
            'species' => $this->faker->randomElement(['Cachorro', 'Gato', 'Ave']),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'weight' => $this->faker->randomFloat(2, 1, 50),
            'birth_date' => $this->faker->date(),
            'castrated' => $this->faker->boolean(),
            'castration_at' => $this->faker->optional()->date(),
            'castration_site' => $this->faker->optional()->city(),
            'size' => $this->faker->randomElement(['Pequeno', 'Médio', 'Grande']),
            'color' => $this->faker->safeColorName(),
            'coat' => $this->faker->word(),
            'characteristics' => $this->faker->sentence(),
            'surname' => $this->faker->lastName(),
            'entry_date' => $this->faker->date(),
            'picture' => $this->faker->imageUrl(640, 480, 'animals', true),
            'collection_site' => $this->faker->optional()->city(),
            'collection_reason' => $this->faker->optional()->sentence(),
            'microchip_number' => $this->faker->optional()->numerify('##########'),
            'registration_number' => $this->faker->unique()->numerify('REG-#####'),
        ];
    }
}
