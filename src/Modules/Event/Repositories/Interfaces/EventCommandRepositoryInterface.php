<?php

namespace Modules\Event\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventCreateRequestDto;
use Modules\Event\Dto\EventUpdateRequestDto;

interface EventCommandRepositoryInterface
{
    public function create(EventCreateRequestDto $dto): Event;

    public function update(EventUpdateRequestDto $dto): Event;

    public function delete(int $eventId): void;
}
