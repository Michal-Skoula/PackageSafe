<?php

namespace App\Models\DataTypes;

use App\Models\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property-read Day|null $day
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Humidity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Humidity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Humidity query()
 * @mixin \Eloquent
 */
class Humidity extends Model
{
	use HasFactory;
	protected $guarded = [];
	public function day() : belongsTo {
		return $this->belongsTo(Day::class);
	}
}
