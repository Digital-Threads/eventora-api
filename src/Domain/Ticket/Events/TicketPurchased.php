<?php

namespace Domain\Ticket\Events;

use Illuminate\Foundation\Events\Dispatchable;

final class TicketPurchased
{
    use Dispatchable;

    public function __construct(public readonly int $eventId, public readonly int $ticketCount = 1) {}
}
