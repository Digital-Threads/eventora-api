<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Infrastructure\Eloquent\Models\EventTransaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property int|null $ticket_id
 * @property float $amount
 * @property string $payment_method
 * @property string|null $transaction_id
 * @property string $status
 * @property Carbon|null $completed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class EventTransaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_id',
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
        'user_id'      => 'integer',
        'event_id'     => 'integer',
        'ticket_id'    => 'integer',
        'amount'       => 'float',
        'completed_at' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    /**
     * Связь с пользователем.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с мероприятием.
     *
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Связь с билетом.
     *
     * @return BelongsTo
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}