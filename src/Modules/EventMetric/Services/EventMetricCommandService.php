<?php

namespace Modules\EventMetric\Services;

use Domain\EventMetric\Repositories\EventMetricCommandRepositoryInterface;

final class EventMetricCommandService
{
    public function __construct(
        private readonly EventMetricCommandRepositoryInterface $eventMetricCommandRepository
    ) {}

    public function incrementViews(int $eventId): void
    {
        $this->eventMetricCommandRepository->incrementViews($eventId);
    }

    public function incrementTicketsSold(int $eventId, int $count): void
    {
        $this->eventMetricCommandRepository->incrementTicketsSold($eventId, $count);
    }

    public function incrementSubscriptions(int $eventId, int $count): void
    {
        $this->eventMetricCommandRepository->incrementSubscriptions($eventId, $count);
    }

    public function updateMetrics(int $eventId, array $data): void
    {
        $this->eventMetricCommandRepository->updateMetrics($eventId, $data);
    }
}
