<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class PdiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree_color' => fake('es_ES')->safeColorName(),
            'thesis_date' => fake()->date(),
       //     'user_id' => fake()->numberBetween(1,20), //Cambiar buscar por role
        ];
    }
} 