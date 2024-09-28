<?php

namespace Infrastructure\Eloquent\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Invitation
 *
 * @property int $id
 * @property int $event_id
 * @property int $sender_id
 * @property string $recipient_email
 * @property string $status
 * @property Carbon|null $sent_at
 * @property Carbon|null $responded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'sender_id', 'recipient_email', 'status', 'sent_at', 'responded_at'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}