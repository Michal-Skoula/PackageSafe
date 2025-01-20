<?php

namespace Database\Seeders;

use App\Models\DataTypes\Collision;
use App\Models\DataTypes\Humidity;
use App\Models\DataTypes\Rotation;
use App\Models\DataTypes\Temperature;
use App\Models\Day;
use App\Models\Tower;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	protected int $tower_count = 10;
    /**
     * Seed the application's database.`
     */
    public function run(): void
    {
		for($i = 0; $i < $this->tower_count; $i++)
		{
			$day_count = rand(5,10) * 4;

			Tower::factory()
				->has(Day::factory()
					->count($day_count)
					->state(new Sequence(
						['data_type' => 'temperature'],
						['data_type' => 'humidity'],
						['data_type' => 'collision'],
						['data_type' => 'rotation']
					))
					->has(Temperature::factory()->count(4))
					->has(Humidity::factory()->count(4))
					->has(Collision::factory()->count(4))
					->has(Rotation::factory()->count(4))
			)
			->count(1)->create();
		}

    }
}
