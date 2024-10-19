<?php

namespace Modules\Event\Repositories\Interfaces;

use Modules\Event\Dto\EventCreateRequestDto;
use Modules\Event\Dto\EventUpdateRequestDto;
use Infrastructure\Eloquent\Models\Event;

interface EventCommandRepositoryInterface
{
    public function create(EventCreateRequestDto $dto): Event;

    public function update(EventUpdateRequestDto $dto): Event;

    public function delete(int $eventId): void;
}
