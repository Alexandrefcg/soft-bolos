<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'weight' => $this->faker->numberBetween(100, 1000),
            'value' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->numberBetween(1, 50),
        ];
    }
}
