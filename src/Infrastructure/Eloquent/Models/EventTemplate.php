<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EventTemplate
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property array $template_data
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class EventTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'template_data', 'created_by'];

    protected $casts    = ['template_data' => 'array'];

    // Один ко многим: шаблон был создан пользователем
    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Event::class, 'template_id');
    }
}
