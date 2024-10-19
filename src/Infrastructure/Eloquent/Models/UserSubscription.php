<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\UserSubscription
 *
 * @property int         $id
 * @property int         $user_id
 * @property int         $subscription_plan_id
 * @property Carbon      $started_at
 * @property Carbon      $ends_at
 * @property bool        $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User             $user
 * @property SubscriptionPlan $subscriptionPlan
 */
class UserSubscription extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'started_at',
        'ends_at',
        'is_active',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Связь с моделью пользователя.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с моделью плана подписки.
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
