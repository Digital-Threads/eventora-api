<?php

namespace Domain\EventMetric\Repositories;

use Infrastructure\Eloquent\Models\EventMetric;

interface EventMetricQueryRepositoryInterface
{
    public function findByEventId(int $eventId): ?EventMetric;

    public function getPopularEvents(int $perPage, ?string $cursor): iterable;

    public function getPopularEventIds(int $perPage, ?string $cursor): array;
}
