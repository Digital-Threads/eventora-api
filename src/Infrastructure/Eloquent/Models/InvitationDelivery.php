<?php

namespace Infrastructure\Eloquent\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'recipient_contact',
        'channel',
        'status',
        'retry_count',
    ];


    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class, 'invitation_id');
    }
}
