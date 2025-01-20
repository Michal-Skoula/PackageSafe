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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rotation query()
 * @mixin \Eloquent
 */
class Rotation extends Model
{
	use HasFactory;
	protected $guarded = [];
	public function day() : belongsTo {
		return $this->belongsTo(Day::class);
	}
}
