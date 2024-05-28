<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
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
            'phone'=>fake()->phoneNumber(),
            'email'=>fake()->email(),
            'company_id'=>random_int(1,10),
            'address'=>fake()->address(),
            'facebook'=>fake()->url(),
            'linkedin'=>fake()->url(),
            'instagram'=>fake()->url(),
            'note'=>fake()->realText(),
            'isLead'=>random_int(0,1),
        ];
    }
}
