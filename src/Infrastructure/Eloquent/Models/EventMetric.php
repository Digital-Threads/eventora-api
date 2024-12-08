<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class EventMetric extends Model
{
    protected $table = 'event_metrics';

    protected $fillable = [
        'event_id',
        'views',
        'tickets_sold',
        'subscriptions',
        'comments',
        'likes',
        'rating',
        'participants',
        'shares',
    ];
}
