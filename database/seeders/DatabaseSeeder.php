<?php

namespace Database\Seeders;

use App\Models\Data;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		$time = now();

		for($i = 0; $i < 100; $i++ ) {
			$time->subSecond();
			Data::factory()->set_time($time)->create();
		}

    }
}
