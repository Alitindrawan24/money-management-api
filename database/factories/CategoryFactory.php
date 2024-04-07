<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            "name" => $this->faker->sentence(1),
            "type" => \rand() % 2 == 0 ? "in" : "out",
            "status" => 1,
        ];
    }
}
