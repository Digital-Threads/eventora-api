<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Attendee
 *
 * @property int $id
 * @property int $event_id
 * @property int|null $user_id
 * @property int|null $ticket_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $check_in_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Attendee extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'ticket_id', 'status', 'check_in_time'];

    // Один ко многим: участник принадлежит событию
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Один ко многим: участник имеет билет
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Один ко многим: участник может быть пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}