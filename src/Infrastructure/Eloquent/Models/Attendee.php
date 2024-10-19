<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Infrastructure\Eloquent\Models\Attendee
 *
 * @property int         $id
 * @property int         $event_id
 * @property int         $user_id
 * @property bool        $checked_in
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Attendee extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'checked_in',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'checked_in' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь с событием.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Связь с пользователем.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
