<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccine>
 */
class VaccineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->unique()->word().' Vaccine',
            'type' => $this->faker->randomElement(['Viral', 'Bacterial', 'Combined']),
            'status' => 'active',
            'purpose' => $this->faker->sentence(),
            'target_specie' => $this->faker->randomElement(['Dog', 'Cat', 'Both']),
            'dose_count' => $this->faker->numberBetween(1, 5),
            'dose_interval' => $this->faker->numberBetween(7, 30),
            'manu_facturer' => $this->faker->company(),
            'expiration_date' => $this->faker->dateTimeBetween('+1 week', '+2 years'),
            'batch' => strtoupper(Str::random(10)),
            'updated_by' => null,
            'alert_at' => null,
            'alert_sent' => false,
        ];
    }
}
