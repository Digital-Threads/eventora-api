<?php

namespace Infrastructure\Eloquent\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property bool $read
 * @property \Illuminate\Support\Carbon|null $sent_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'read', 'sent_at'];

    // Один ко многим: уведомление принадлежит пользователю
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}