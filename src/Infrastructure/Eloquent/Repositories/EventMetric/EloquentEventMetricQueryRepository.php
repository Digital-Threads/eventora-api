<?php

namespace Infrastructure\Eloquent\Repositories\EventMetric;

use Domain\EventMetric\Repositories\EventMetricQueryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Infrastructure\Eloquent\Models\EventMetric;

class EloquentEventMetricQueryRepository implements EventMetricQueryRepositoryInterface
{
    public function findByEventId(int $eventId): ?EventMetric
    {
        return EventMetric::query()->where('event_id', $eventId)->first();
    }

    public function getPopularEvents(int $perPage, ?string $cursor): iterable
    {
        return EventMetric::query()
            ->join('events', 'events.id', '=', 'event_metrics.event_id')
            ->select('events.*')
            ->orderByRaw('(views * 0.5 + tickets_sold * 1.5 + subscriptions * 2 + likes * 1 + comments * 0.5) DESC')
            ->cursorPaginate($perPage, cursor: $cursor);
    }

    public function getPopularEventIds(int $perPage, ?string $cursor): array
    {
        return DB::table('event_metrics')
            ->select('event_id')
            ->orderByRaw('(views * 0.5 + tickets_sold * 1.5 + subscriptions * 2 + likes * 1 + comments * 0.5) DESC')
            ->limit($perPage)
            ->pluck('event_id')
            ->toArray();
    }
}
