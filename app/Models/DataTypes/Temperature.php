<?php

namespace App\Models\DataTypes;

use App\Models\Day;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temperature extends Model
{
	protected $guarded = [];
	public function day() : belongsTo {
		return $this->belongsTo(Day::class);
	}
}
