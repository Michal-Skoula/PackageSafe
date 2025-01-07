<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property float|null $temperature
 * @property float|null $humidity
 * @property int|null $co2
 * @property int|null $pressure
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DataFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereCo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Data extends Model
{
    /** @use HasFactory<\Database\Factories\DataFactory> */
    use HasFactory;
}
