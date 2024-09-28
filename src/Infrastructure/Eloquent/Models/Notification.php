<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property bool $read
 * @property Carbon|null $sent_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'read', 'sent_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}