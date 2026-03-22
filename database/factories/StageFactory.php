<?php

namespace Database\Factories;

use App\Models\Journey;
use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'       => $this->faker->word(),
            'journey_id' => Journey::factory(),
        ];
    }
}
