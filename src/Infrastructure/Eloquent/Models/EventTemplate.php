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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class EventTemplate extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'template_data',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'template_data' => 'array',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];
}