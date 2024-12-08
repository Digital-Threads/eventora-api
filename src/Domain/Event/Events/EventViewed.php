<?php

namespace Domain\Event\Events;

use Illuminate\Foundation\Events\Dispatchable;

final class EventViewed
{
    use Dispatchable;

    public function __construct(public readonly int $eventId) {}
}
