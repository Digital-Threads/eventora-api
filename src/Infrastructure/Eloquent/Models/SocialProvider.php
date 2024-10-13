<?php

namespace Infrastructure\Eloquent\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Infrastructure\Eloquent\Models\SocialProvider
 *
 * @property int         $id
 * @property int         $user_id
 * @property string      $provider_name
 * @property string      $provider_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class SocialProvider extends Model
{
    use HasFactory;

    // Указываем явное имя таблицы
    protected $table = 'social_providers';

    // Указываем заполняемые поля
    protected $fillable = [
        'user_id',
        'provider_name',
        'provider_id',
    ];

    /**
     * Связь с моделью User.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
