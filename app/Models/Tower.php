<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Day> $days
 * @property-read int|null $days_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tower query()
 * @mixin \Eloquent
 */
class Tower extends Model
{
	use HasFactory;
	protected $fillable = ['user_id','name','status'];
	public function latestDay(string $data_type)
	{
		return Day::where('data_type',$data_type)->latest('date')->first();
	}
	public function oldestDay(string $data_type)
	{
		return Day::where('data_type',$data_type)->oldest('date')->first();
	}
	public function daysCount(string $data_type) :? int
	{
		if($this->days()->exists()) {
			$first_day = $this->oldestDay($data_type)->date;
			$last_day = $this->latestDay($data_type)->date;

			return Carbon::parse($first_day)->diffInDays($last_day);
		}
		else {
			return null;
		}

	}

    public function user() : belongsTo {
		return $this->belongsTo(User::class);
	}

	public function days() : HasMany {
		return $this->hasMany(Day::class);
	}
}
