<?php

namespace Modules\Event\Repositories\Interfaces;

use Modules\Event\Dto\EventCreateDto;
use Modules\Event\Dto\EventUpdateDto;
use Infrastructure\Eloquent\Models\Event;

interface EventCommandRepositoryInterface
{
    public function create(EventCreateDto $dto): Event;

    public function update(EventUpdateDto $dto): Event;

    public function delete(int $eventId): void;
}