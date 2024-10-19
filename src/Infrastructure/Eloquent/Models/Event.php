<?php

namespace Infrastructure\Eloquent\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int         $id
 * @property string      $title
 * @property string|null $description
 * @property Carbon      $event_date
 * @property string|null $location
 * @property bool        $is_public
 * @property int         $organizer_id
 * @property int|null    $category_id
 * @property int|null    $template_id
 * @property int|null    $company_id
 * @property string|null $terms_conditions
 * @property string|null $image_url
 * @property int|null    $max_participants
 * @property int|null    $age_limit
 * @property string|null $event_type
 * @property string|null $streaming_link
 * @property array|null  $tags
 * @property Carbon|null $registration_deadline
 * @property string|null $qr_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Event extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'is_public',
        'organizer_id',
        'category_id',
        'template_id',
        'company_id',
        'terms_conditions',
        'image_url',
        'max_participants',
        'age_limit',
        'event_type',
        'streaming_link',
        'tags',
        'registration_deadline',
        'qr_code',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'event_date'            => 'datetime',
        'is_public'             => 'boolean',
        'tags'                  => 'array',
        'registration_deadline' => 'datetime',
        'created_at'            => 'datetime',
        'updated_at'            => 'datetime',
    ];

    /**
     * Связь с организатором (пользователь).
     *
     * @return BelongsTo
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * Связь с категорией мероприятия.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    /**
     * Связь с шаблоном мероприятия.
     *
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(EventTemplate::class, 'template_id');
    }

    /**
     * Связь с компанией.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
