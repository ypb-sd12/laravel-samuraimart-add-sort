<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            // 'description' => fake()->realText(20),
            // 'price' => fake()->randomNumber(6, false),
            'description' => fake()->realText(50,5),
            'price' => fake()->numberBetween(100, 200000),
            'category_id' => fake()->numberBetween(1, 15),
        ];
    }
}
