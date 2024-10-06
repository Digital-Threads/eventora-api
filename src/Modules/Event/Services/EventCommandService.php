<?php

namespace Modules\Event\Services;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventCreateDto;
use Modules\Event\Dto\EventDeleteRequestDto;
use Modules\Event\Dto\EventUpdateDto;
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
     * @param EventUpdateDto $event
     *
     * @return Event
     */
    public function update(EventUpdateDto $event): Event{
        return $this->eventCommandRepository->update($event);
    }

    /**
     * @param EventDeleteRequestDto $dto
     *
     * @return void
     */
    public function delete(EventDeleteRequestDto $dto): void
    {
        $this->eventCommandRepository->delete($dto->id);


    }
}
