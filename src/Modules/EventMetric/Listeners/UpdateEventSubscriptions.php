<?php

namespace Modules\EventMetric\Listeners;

use Domain\Event\Events\EventSubscribed;
use Domain\EventMetric\Repositories\EventMetricCommandRepositoryInterface;

final class UpdateEventSubscriptions
{
    public function __construct(
        private readonly EventMetricCommandRepositoryInterface $repository
    ) {}

    public function handle(EventSubscribed $event): void
    {
        $this->repository->incrementSubscriptions($event->eventId, $event->subscriptionCount);
    }
}
