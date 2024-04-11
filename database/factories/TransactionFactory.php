<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            "user_id" => function() {
                return User::factory()->create()->id;
            },
            "category_id" => function() {
                return Category::factory()->create()->id;
            },
            "date" => $this->faker->date(),
            "amount" => $this->faker->randomFloat(0, 100, 1000) * 100,
            "description" => $this->faker->sentence(5),
        ];
    }
}
