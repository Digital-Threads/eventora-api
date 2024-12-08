<?php

namespace Modules\EventMetric\Listeners;

use Domain\EventMetric\Repositories\EventMetricCommandRepositoryInterface;
use Domain\Ticket\Events\TicketPurchased;

final class UpdateEventTicketsSold
{
    public function __construct(
        private readonly EventMetricCommandRepositoryInterface $repository
    ) {}

    public function handle(TicketPurchased $event): void
    {
        $this->repository->incrementTicketsSold($event->eventId, $event->ticketCount);
    }
}
