<?php

namespace Modules\EventMetric\Services;

use Domain\EventMetric\Repositories\EventMetricQueryRepositoryInterface;
use Infrastructure\Eloquent\Models\EventMetric;

final class EventMetricQueryService
{
    public function __construct(
        private readonly EventMetricQueryRepositoryInterface $eventMetricQueryRepository
    ) {}

    public function findByEventId(int $eventId): ?EventMetric
    {
        return $this->eventMetricQueryRepository->findByEventId($eventId);
    }

    public function getPopularEvents(int $perPage, ?string $cursor): iterable
    {
        return $this->eventMetricQueryRepository->getPopularEvents($perPage, $cursor);
    }
}
