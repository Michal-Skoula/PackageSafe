<?php

namespace Database\Factories\DataTypes;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RotationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'rotation_x' => fake()->numberBetween(0,360),
			'rotation_y' => fake()->numberBetween(0,360),
			'rotation_z' => fake()->numberBetween(0,360),
		];
    }
}
