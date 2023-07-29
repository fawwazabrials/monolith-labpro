<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "item_name" => fake()->word(),
            "amount" => fake()->numberBetween(1, 6),
            "price" => fake()->numberBetween(5, 50) * 10000,
        ];
    }
}
