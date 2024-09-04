<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Garment>
 */
class GarmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('es_ES')->sentence(),
            'height' => fake()->numberBetween(100,220),
            'width' => fake()->numberBetween(40,80),
            'waist' => fake()->numberBetween(40,100),
            'size_cap' => fake()->numberBetween(20,70),
            'color' => fake('es_ES')->safeColorName(),
            'with_cap' => fake()->boolean(),
            //'pdi_id' => fake()->numberBetween(1,20),
        ];
    }
}
