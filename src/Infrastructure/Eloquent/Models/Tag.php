<?php

namespace Infrastructure\Eloquent\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Class Role
 *
 * @property int                    $id
 * @property string                 $name
 * @property Carbon|null            $created_at
 * @property Carbon|null            $updated_at
 *
 * @property-read Collection|User[] $users
 */
class Tag extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Связь "один ко многим" с моделью User.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
