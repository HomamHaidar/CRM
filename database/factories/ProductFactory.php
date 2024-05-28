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
            'name'=>fake()->name(),
            'quantity'=>fake()->numberBetween(1,10),
            'wholesale_price'=>fake()->numberBetween(10,100),
            'selling_price'=>fake()->numberBetween(100,1000),
            'image'=>fake()->imageUrl(),

        ];
    }
}
