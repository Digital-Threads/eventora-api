<?php

namespace Modules\EventMetric\Listeners;

use Domain\Event\Events\EventViewed;
use Domain\EventMetric\Repositories\EventMetricCommandRepositoryInterface;

final class UpdateEventViews
{
    public function __construct(
        private readonly EventMetricCommandRepositoryInterface $repository
    ) {}

    public function handle(EventViewed $event): void
    {
        $this->repository->incrementViews($event->eventId);
    }
}
