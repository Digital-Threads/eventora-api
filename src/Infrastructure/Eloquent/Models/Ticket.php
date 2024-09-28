<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Infrastructure\Eloquent\Models\Ticket
 *
 * @property int $id
 * @property int $event_id
 * @property string $type
 * @property float $price
 * @property int $quantity
 * @property int $sold_quantity
 * @property float|null $discount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Ticket extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'event_id',
        'type',
        'price',
        'quantity',
        'sold_quantity',
        'discount',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'price'         => 'decimal:2',
        'quantity'      => 'integer',
        'sold_quantity' => 'integer',
        'discount'      => 'decimal:2',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /**
     * Связь с событием.
     *
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}