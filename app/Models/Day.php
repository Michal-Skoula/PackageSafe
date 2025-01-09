<?php

namespace App\Models;

use App\Models\DataTypes\Collision;
use App\Models\DataTypes\Humidity;
use App\Models\DataTypes\Rotation;
use App\Models\DataTypes\Temperature;
use Illuminate\Database\Eloquent\Model;
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
	public function towers() : belongsTo {
		return $this->belongsTo(Tower::class);
	}

    public function temperature() : hasMany {
		return $this->hasMany(Temperature::class);
	}

	public function humidity() : hasMany {
		return $this->hasMany(Humidity::class);
	}

	public function rotation() : hasMany {
		return $this->hasMany(Rotation::class);
	}

	public function collision() : hasMany {
		return $this->hasMany(Collision::class);
	}
}
