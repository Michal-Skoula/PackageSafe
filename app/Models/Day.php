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

	public static array $allowed_data_types = ['temperature','collision','rotation','humidity'];

	protected static array $models = [
		'temperature' 	=> Temperature::class,
		'humidity' 		=> Humidity::class,
		'rotation' 		=> Rotation::class,
		'collision' 	=> Collision::class,
	];
	public static function isValidDataType($data_type) : bool
	{
		return in_array($data_type, static::$allowed_data_types);
	}

	/**
	 * Get a collection of days from a start date
	 * @param  string  $data_type
	 * @param  int  $tower_id
	 * @param  int  $num_of_days
	 * @param  string  $date_from
	 * @return Collection|null
	 */
	public static function days(string $data_type, int $tower_id, int $num_of_days = 1, string $date_from = '') : Collection|null
	{
		if(!static::isValidDataType($data_type) || !Tower::find($tower_id)) {
			return null;
		}

		if($date_from == '') {
			$date_from = now()->format('Y-m-d');
		}

		$start_date = Carbon::parse($date_from)->subDays($num_of_days);

		return Day::whereBetween('date', [$start_date, $date_from])
			->where([
				['data_type','=',$data_type],
				['tower_id', '=', $tower_id]
			])->get();
	}

	/**
	 * Returns averages of N number of days for a given tower as a key value array of [$date => $value]
	 * @param  string  $data_type
	 * @param  int  $tower_id
	 * @param  int  $num_of_days
	 * @param  string  $date_from
	 * @return array|null
	 */
	public static function daysAvg(string $data_type, int $tower_id, int $num_of_days = 1, string $date_from = ''): ?array
	{
		$days = static::days($data_type, $tower_id, $num_of_days, $date_from);
		if (!$days) {
			return null;
		}

		$avg = [];
		$date_from = $date_from ?: now()->format('Y-m-d');
		$date_current = Carbon::parse($date_from)->subDays($num_of_days - 1);

		for ($i = 0; $i < $num_of_days; $i++) {
			$day = $days->where('date', '=', $date_current->format('Y-m-d'))->first();

			if ($day) {
				$values = match ($data_type) {
					'temperature' => $day->temperatures()->get(),
					'collision' => $day->collisions()->get(),
					'rotation' => $day->rotations()->get(),
					'humidity' => $day->humidities()->get(),
					default => collect(),
				};

				$value = $values->avg($data_type);
				$avg[] = [$date_current->format('Y-m-d') => $value];
			} else {
				$avg[] = [$date_current->format('Y-m-d') => 0];
			}

			$date_current->addDay();
		}

		return [
			'days' => $num_of_days,
			'values' => $avg
		];
	}

	/**
	 * Returns the current latestData data entry from the requested tower
	 * @param  string  $data_type
	 * @param  int  $tower_id
	 * @return int|float|null
	 */
	public static function latestData(string $data_type, int $tower_id) : int|float|null
	{
		if(!self::isValidDataType($data_type) || !Tower::find($tower_id)) {
			return null;
		}

		$day = static::where('tower_id', $tower_id)
			->latest('created_at')
			->first();

		if(!$day) {
			return null;
		}

		$model = new static::$models[$data_type];

		$data = $model->where('day_id', $day->id)
			->latest('created_at')
			->first();

		return $data ? $data->$data_type : null;
	}

	public static function todayEntryExists(string $data_type, int $tower_id, string $date = '') : bool
	{
		return !self::days($data_type, $tower_id, 1, $date)->isEmpty();
	}

	public static function getAllDaysAvg(string $data_type, int $tower_id, string $date = '') : ?array
	{
		$days = Tower::find($tower_id)->daysCount($data_type);

		if(!$days) { return null; }

		return static::daysAvg($data_type, $tower_id, $days + 1, $date);
	}
	public static function getDay(string $data_type, int $tower_id, string $date = '') : ?array
	{
		return static::daysAvg($data_type, $tower_id, 1, $date);
	}
	public static function getWeek(string $data_type, int $tower_id, string $startingDate = '') : ?array
	{
		return static::daysAvg($data_type, $tower_id, 7, $startingDate);
	}
	public static function getTwoWeeks(string $data_type, int $tower_id, string $startingDate = '') : ?array
	{
		return static::daysAvg($data_type, $tower_id, 14, $startingDate);
	}
	public static function getMonth(string $data_type, int $tower_id, string $startingDate = '') : array
	{
		return static::daysAvg($data_type, $tower_id, 30, $startingDate);
	}


	// DB Relations

	public function tower() : belongsTo {
		return $this->belongsTo(Tower::class);
	}

    public function temperatures() : hasMany {
		return $this->hasMany(Temperature::class);
	}

	public function humidities() : hasMany {
		return $this->hasMany(Humidity::class);
	}

	public function rotations() : hasMany {
		return $this->hasMany(Rotation::class);
	}

	public function collisions() : hasMany {
		return $this->hasMany(Collision::class);
	}
}
