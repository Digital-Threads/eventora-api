<?php

namespace Modules\Frontend\Dashboard\Event\Services;

use Infrastructure\Eloquent\Models\Event;
use Modules\Frontend\Dashboard\Event\Dto\EventCreateRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventDeleteRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventUpdateRequestDto;
use Modules\Frontend\Dashboard\Event\Repositories\Interfaces\EventCommandRepositoryInterface;

final class EventCommandService
{
    /**
     */
    public function __construct(private EventCommandRepositoryInterface $eventCommandRepository)
    {
    }

    /**
     *
     */
    public function create(EventCreateRequestDto $dto): Event
    {
        return $this->eventCommandRepository->create($dto);
    }

    /**
     *
     */
    public function update(EventUpdateRequestDto $dto): Event
    {
        return $this->eventCommandRepository->update($dto);
    }

    /**
     *
     */
    public function delete(EventDeleteRequestDto $dto): void
    {
        $this->eventCommandRepository->delete($dto->id);
    }
}
