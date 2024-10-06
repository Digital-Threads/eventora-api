<?php

namespace Modules\Event\Services;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventCreateRequestDto;
use Modules\Event\Dto\EventDeleteRequestDto;
use Modules\Event\Dto\EventUpdateRequestDto;
use Modules\Event\Repositories\Interfaces\EventCommandRepositoryInterface;

final class EventCommandService
{
    /**
     * @param  EventCommandRepositoryInterface  $eventCommandRepository
     */
    public function __construct(private EventCommandRepositoryInterface $eventCommandRepository) {}

    /**
     * @param  EventCreateRequestDto  $dto
     *
     * @return Event
     */
    public function create(EventCreateRequestDto $dto): Event
    {
        return $this->eventCommandRepository->create($dto);
    }

    /**
     * @param EventUpdateRequestDto $dto
     *
     * @return Event
     */
    public function update(EventUpdateRequestDto $dto): Event
    {
        return $this->eventCommandRepository->update($dto);
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
