<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property Carbon $event_date
 * @property string|null $location
 * @property bool $is_public
 * @property int $organizer_id
 * @property int|null $template_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'event_date', 'location', 'is_public', 'organizer_id', 'template_id'];

    public function organizer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function template(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EventTemplate::class, 'template_id');
    }

    // Один ко многим: событие может иметь много билетов
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function invitations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function attendees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attendee::class);
    }
}
