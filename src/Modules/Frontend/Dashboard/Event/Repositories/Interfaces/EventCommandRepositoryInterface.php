<?php

namespace Modules\Frontend\Dashboard\Event\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Event;
use Modules\Frontend\Dashboard\Event\Dto\EventCreateRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventUpdateRequestDto;

interface EventCommandRepositoryInterface
{
    public function create(EventCreateRequestDto $dto): Event;

    public function update(EventUpdateRequestDto $dto): Event;

    public function delete(int $eventId): void;
}
