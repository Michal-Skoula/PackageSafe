<?php

namespace App\Models;

use App\Models\DataTypes\Collision;
use App\Models\DataTypes\Humidity;
use App\Models\DataTypes\Rotation;
use App\Models\DataTypes\Temperature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
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
