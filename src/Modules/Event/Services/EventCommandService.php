<?php

namespace Modules\Event\Services;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventCreateDto;
use Modules\Event\Repositories\Interfaces\EventCommandRepositoryInterface;

final class EventCommandService
{
    /**
     * @param  EventCommandRepositoryInterface  $eventCommandRepository
     */
    public function __construct(private EventCommandRepositoryInterface $eventCommandRepository) {}

    /**
     * @param  EventCreateDto  $dto
     *
     * @return Event
     */
    public function create(EventCreateDto $dto): Event
    {
        return $this->eventCommandRepository->create($dto);
    }

    /**
     * @return EventCommandRepositoryInterface
     */
    public function getEventCommandRepository(): EventCommandRepositoryInterface
    {
        return $this->eventCommandRepository;
    }

    /**
     * @param  EventCommandRepositoryInterface  $eventCommandRepository
     */
    public function setEventCommandRepository(EventCommandRepositoryInterface $eventCommandRepository): void
    {
        $this->eventCommandRepository = $eventCommandRepository;
    }
}