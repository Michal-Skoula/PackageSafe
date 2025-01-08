<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tower extends Model
{
    public function user() : belongsTo {
		return $this->belongsTo(User::class);
	}

	public function days() : HasMany {
		return $this->hasMany(Day::class);
	}
}
