<?php

namespace Database\Factories;

use App\Domains\Enums\BankAccountPixTypeEnum;
use App\Domains\Enums\BankAccountTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'accountable_type' => 'App\Domains\Collaborator\Entities\CollaboratorEntity',
            'accountable_id' => 1,
            'account_type' => BankAccountTypeEnum::CURRENT_ACCOUNT,
            'bank_code' => fake()->randomNumber(3, true),
            'bank_name' => fake()->company(),
            'agency' => fake()->randomNumber(4, true),
            'account_number' => fake()->randomNumber(6, true) . '-' . fake()->randomDigit(),
            'account_holder_name' => fake()->name(),
            'account_holder_document' => fake()->unique()->numerify('###########'),
            'pix_key' => fake()->unique()->email(),
            'pix_key_type' => BankAccountPixTypeEnum::EMAIL,
        ];
    }
}
