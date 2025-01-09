<?php

namespace App\Models\DataTypes;

use App\Models\Day;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property-read Day|null $day
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Collision query()
 * @mixin \Eloquent
 */
class Collision extends Model
{
	protected $guarded = [];
    public function day() : belongsTo {
		return $this->belongsTo(Day::class);
	}
}
