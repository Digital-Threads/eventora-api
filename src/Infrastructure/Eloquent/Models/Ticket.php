<?php

namespace Infrastructure\Eloquent\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $event_id
 * @property float $price
 * @property string $type
 * @property string $qr_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'price', 'type', 'qr_code'];

    // Один ко многим: билет связан с событием
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Один ко многим: билет может быть назначен участнику
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }
}