<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Infrastructure\Eloquent\Models\Invitation
 *
 * @property int $id
 * @property int $event_id
 * @property int|null $user_id
 * @property string $title
 * @property string|null $message
 * @property string $invitation_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'message',
        'title',
        'invitation_link',
    ];

    /**
     * Связь с доставками приглашений.
     */
    public function deliveries(): HasMany
    {
        return $this->hasMany(InvitationDelivery::class, 'invitation_id');
    }

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
