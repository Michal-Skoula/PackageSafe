<?php

namespace App\Models\DataTypes;

use App\Models\Day;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property-read Day|null $day
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Temperature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Temperature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Temperature query()
 * @mixin Eloquent
 */
class Temperature extends Model
{
	protected $guarded = [];
	public function day() : belongsTo {
		return $this->belongsTo(Day::class);
	}
}
