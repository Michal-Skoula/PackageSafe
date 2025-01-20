<?php

namespace Database\Factories;

use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tower>
 */
class TowerFactory extends Factory
{
	protected array $companies = ['DPD','PPL','DHL','ČP'];

	/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$number = fake()->randomNumber(6,true);
		$company = Arr::random($this->companies,1);

		$order_name = "$company[0]-$number";

        return [
			'user_id' 	=> 1,
            'name' 		=> $order_name,
			'status' 	=> fake()->numberBetween(1,4),
        ];
    }

	public function customUserId($id): static
	{
		return $this->state(fn(array $attributes) => [
			'user_id' => $id
		]);
	}
}
