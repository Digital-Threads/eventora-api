<?php

namespace Modules\Event\Services;

use Modules\Event\Dto\EventCreateRequestDto;
use Modules\Event\Dto\EventDeleteRequestDto;
use Modules\Event\Dto\EventUpdateRequestDto;
use Domain\Event\Repositories\EventCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Event;

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
