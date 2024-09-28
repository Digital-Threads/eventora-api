<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Infrastructure\Eloquent\Models\Invitation
 *
 * @property int $id
 * @property int $event_id
 * @property int|null $user_id
 * @property string $recipient_contact
 * @property string $channel
 * @property string|null $message
 * @property string $invitation_link
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Invitation extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'recipient_contact',
        'channel',
        'message',
        'invitation_link',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'event_id'          => 'integer',
        'user_id'           => 'integer',
        'recipient_contact' => 'string',
        'channel'           => 'string',
        'message'           => 'string',
        'invitation_link'   => 'string',
        'status'            => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
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

    /**
     * Связь с пользователем.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}