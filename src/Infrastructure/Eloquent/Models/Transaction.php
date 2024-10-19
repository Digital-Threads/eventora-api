<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Infrastructure\Eloquent\Models\Transaction
 *
 * @property int         $id
 * @property int         $user_id
 * @property int|null    $subscription_plan_id
 * @property string      $transaction_type
 * @property float       $amount
 * @property string      $payment_method
 * @property string|null $transaction_id
 * @property string      $status
 * @property Carbon|null $completed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'transaction_type',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'completed_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'user_id' => 'integer',
        'subscription_plan_id' => 'integer',
        'amount' => 'float',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь с пользователем.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с планом подписки.
     */
    public function subscriptionPlan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
}
