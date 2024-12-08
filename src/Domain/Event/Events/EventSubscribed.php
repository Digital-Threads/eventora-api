<?php

namespace Domain\Event\Events;

use Illuminate\Foundation\Events\Dispatchable;

final class EventSubscribed
{
    use Dispatchable;

    public function __construct(public readonly int $eventId, public readonly int $subscriptionCount = 1) {}
}
