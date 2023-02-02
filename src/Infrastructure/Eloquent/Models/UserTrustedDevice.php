<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserTrustedDeviceFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static UserTrustedDeviceFactory factory()
 */
final class UserTrustedDevice extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ip',
        'user_agent',
        'valid_to',
    ];

    protected $casts = [
        'valid_to' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
