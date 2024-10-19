<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Company
 *
 * @property int         $id
 * @property string      $name
 * @property string      $slug
 * @property string|null $description
 * @property string|null $avatar_url
 * @property string|null $website_url
 * @property string|null $activity_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|User[]  $users
 * @property Collection|Event[] $events
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'avatar_url',
        'website_url',
        'activity_description',
    ];

    /**
     * Связь "один ко многим" с моделью User.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Связь "один ко многим" с моделью Event.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

}
