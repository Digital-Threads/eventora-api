<?php

namespace Infrastructure\Eloquent\Models;

use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Infrastructure\Eloquent\Models\InvitationDelivery
 *
 * @property int         $id
 * @property int         $invitation_id
 * @property string      $recipient_contact
 * @property string      $channel
 * @property string      $status
 * @property string      $link
 * @property int         $retry_count
 * @property Invitation  $invitation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class InvitationDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'recipient_contact',
        'channel',
        'link',
        'status',
        'retry_count',
    ];

    protected $casts = [
        'status' => InvitationDeliveryStatus::class,
    ];

    /**
     * Связь с основным приглашением.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class, 'invitation_id');
    }
}
