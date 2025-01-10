<?php

namespace App\Models;

use App\Models\DataTypes\Collision;
use App\Models\DataTypes\Humidity;
use App\Models\DataTypes\Rotation;
use App\Models\DataTypes\Temperature;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Collision> $collision
 * @property-read int|null $collision_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Humidity> $humidity
 * @property-read int|null $humidity_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rotation> $rotation
 * @property-read int|null $rotation_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Temperature> $temperature
 * @property-read int|null $temperature_count
 * @property-read \App\Models\Tower|null $towers
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day query()
 * @mixin \Eloquent
 */
class Day extends Model
{
	protected $guarded = [];

	protected array $models = [
		'temperature' 	=> Temperature::class,
		'humidity' 		=> Humidity::class,
		'rotation' 		=> Rotation::class,
		'collision' 	=> Collision::class,
	];

	/**
	 * Get a collection of days from a start date
	 * @param  string  $data_type Data type of which to retrieve the day
	 * @param  int  $num_of_days How many days should be returned
	 * @param  string  $date_from Starting date
	 * @return Collection
	 */
	public function days(string $data_type, int $num_of_days = 1, string $date_from = '') : Collection
	{
		if($date_from == '') $date_from = now()->format('Y-m-d');
		$start_date = Carbon::parse($date_from)->subDays($num_of_days);


		return Day::whereBetween('date', [$start_date, $date_from])
			->where('data_type','=',$data_type)
			->get();
	}

	/**
	 * Returns averages of N number of days as a key value array of [$date => $value]
	 * @param  string  $data_type
	 * @param  int  $num_of_days
	 * @param  string  $date_from
	 * @return array|null
	 */
	public function daysAvg(string $data_type, int $num_of_days = 1, string $date_from = '') : ?array
	{
		$days = $this->days($data_type, $num_of_days, $date_from);

		$avg = [];
		foreach($days as $day) {
			$values = match ($data_type) {
				'temperature' 	=> $day->temperatures()->get(),
				'collision' 	=> $day->collisions()->get(),
				'rotation' 		=> $day->rotations()->get(),
				'humidity' 		=> $day->humidity()->get(),
				default 		=> null,
			};
			if($values == null) return null;

			$date = $day->date;
			$value = $values->avg($data_type);

			$avg[] = [$date => $value];

		}
		return [
			'days' => $num_of_days,
			'values' => $avg
		];
	}

	public function getDay(string $data_type, string $date = '') : ?array
	{
		return $this->daysAvg($data_type,1, $date);
	}
	public function getWeek(string $data_type, string $startingDate = '') : ?array
	{
		return $this->daysAvg($data_type, 7, $startingDate);
	}
	public function getTwoWeeks(string $data_type, string $startingDate = '') : ?array
	{
		return $this->daysAvg($data_type, 14, $startingDate);
	}
	public function getMonth(string $data_type, string $startingDate = '') : array
	{
		return $this->daysAvg($data_type, 30, $startingDate);
	}


	// DB Relations

	public function towers() : belongsTo {
		return $this->belongsTo(Tower::class);
	}

    public function temperatures() : hasMany {
		return $this->hasMany(Temperature::class);
	}

	public function humidity() : hasMany {
		return $this->hasMany(Humidity::class);
	}

	public function rotations() : hasMany {
		return $this->hasMany(Rotation::class);
	}

	public function collisions() : hasMany {
		return $this->hasMany(Collision::class);
	}
}
