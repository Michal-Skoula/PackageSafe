<?php

namespace App\Models;

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
	protected $fillable = ['user_id','name','status'];
	public function latest(string $data_type)
	{
		return Day::latest($data_type, $this->id);
	}

    public function user() : belongsTo {
		return $this->belongsTo(User::class);
	}

	public function days() : HasMany {
		return $this->hasMany(Day::class);
	}
}
