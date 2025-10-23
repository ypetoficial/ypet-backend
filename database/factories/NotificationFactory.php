<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['alerta', 'lembrete', 'confirmacao', 'informativa']),
            'status' => $this->faker->randomElement(['lida', 'nao_lida']),
            'action_label' => $this->faker->optional()->word(),
            'action_target' => $this->faker->optional()->word(),
            'sent_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
