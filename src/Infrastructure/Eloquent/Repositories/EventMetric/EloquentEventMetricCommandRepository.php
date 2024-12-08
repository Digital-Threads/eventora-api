<?php

namespace Infrastructure\Eloquent\Repositories\EventMetric;


use Domain\EventMetric\Repositories\EventMetricCommandRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Infrastructure\Eloquent\Models\EventMetric;

class EloquentEventMetricCommandRepository implements EventMetricCommandRepositoryInterface
{
    public function incrementSubscriptions(int $eventId, int $count): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['subscriptions' => DB::raw("subscriptions + {$count}")]
        );
    }

    public function incrementTicketsSold(int $eventId, int $count): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['tickets_sold' => DB::raw("tickets_sold + {$count}")]
        );
    }

    public function incrementViews(int $eventId): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['views' => DB::raw('views + 1')]
        );
    }

    public function updateMetrics(int $eventId, array $data): void
    {
        EventMetric::query()->updateOrCreate(['event_id' => $eventId], $data);
    }




    public function incrementComments(int $eventId, int $count): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['comments' => DB::raw("comments + {$count}")]
        );
    }

    public function incrementLikes(int $eventId, int $count): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['likes' => DB::raw("likes + {$count}")]
        );
    }

    public function updateRating(int $eventId, float $rating): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['rating' => $rating]
        );
    }

    public function incrementParticipants(int $eventId, int $count): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['participants' => DB::raw("participants + {$count}")]
        );
    }

    public function incrementShares(int $eventId, int $count): void
    {
        EventMetric::query()->updateOrCreate(
            ['event_id' => $eventId],
            ['shares' => DB::raw("shares + {$count}")]
        );
    }

}
