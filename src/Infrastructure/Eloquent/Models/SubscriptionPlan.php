<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SubscriptionPlan
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $duration_in_days
 * @property string|null $features
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class SubscriptionPlan extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'duration_in_days',
        'features',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'price'            => 'decimal:2',
        'duration_in_days' => 'integer',
    ];
}