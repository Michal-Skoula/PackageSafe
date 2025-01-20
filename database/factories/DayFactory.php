<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Day>
 */
class DayFactory extends Factory
{
	protected static int $days_offset = 0;

	/**
	 * Define the model's default state.
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{

		$day = now()
			->subDays(floor(static::$days_offset / 4 ))
			->format('Y-m-d');

		static::$days_offset++;

		return [
			'date' => $day,
			'data_type' => 'temperature'
		];
	}
	public function dateOverride($date) : static
	{
		return $this->state(fn(array $attributes) => [
			'date' => $date
		]);
	}
	public function customDataType($data_type) : static
	{
		return $this->state(fn(array $attributes) => [
			'data_type' => $data_type
		]);
	}
}
