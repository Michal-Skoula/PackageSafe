<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Data>
 */
class DataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
			'temperature' 	=> fake()->numberBetween(100,400) / 10,
			'humidity' 		=> fake()->numberBetween(0,100),
			'co2' 			=> fake()->numberBetween(300, 800),
			'pressure' 		=> fake()->numberBetween(800, 1600),
		];
    }
	public function set_time($time) : static
	{
		return $this->state([
			'created_at' => $time,
			'updated_at' => $time
		]);
	}
}
