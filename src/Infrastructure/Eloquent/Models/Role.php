<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|User[] $users
 */
class Role extends Model
{
    use HasFactory;

    const string USER = 'user';
    const string ADMIN = 'admin';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @return self
     */
    public static function getDefaultRole(): static
    {
        return self::query()->where('name', self::USER)->first();
    }

    /**
     * Связь "один ко многим" с моделью User.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
