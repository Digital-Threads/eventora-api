<?php

namespace Modules\Event\Services;

use Infrastructure\Eloquent\Models\Event;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Modules\Event\Dto\EventQueryRequestDto;
use Modules\Event\Dto\EventViewRequestDto;
use Modules\Event\Repositories\Interfaces\EventQueryRepositoryInterface;

final class EventQueryService
{
    /**
     * @param  EventQueryRepositoryInterface  $eventQueryRepository
     */
    public function __construct(private EventQueryRepositoryInterface $eventQueryRepository) {}

    /**
     * @param  EventQueryRequestDto  $dto
     *
     * @return CursorPaginator
     */
    public function query(EventQueryRequestDto $dto): CursorPaginator
    {
        return $this->eventQueryRepository->query($dto);
    }

    /**
     * @param  EventViewRequestDto  $dto
     *
     * @return Event
     */
    public function view(EventViewRequestDto $dto): Event
    {
        return $this->eventQueryRepository->view($dto);
    }
}
