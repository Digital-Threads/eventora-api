<?php

namespace Modules\Event\Services;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventViewRequestDto;
use Modules\Event\Dto\EventQueryRequestDto;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Modules\Event\Repositories\Interfaces\EventQueryRepositoryInterface;

final class EventQueryService
{
    /**
     */
    public function __construct(private EventQueryRepositoryInterface $eventQueryRepository)
    {
    }

    /**
     *
     */
    public function query(EventQueryRequestDto $dto): CursorPaginator
    {
        return $this->eventQueryRepository->query($dto);
    }

    /**
     *
     */
    public function view(EventViewRequestDto $dto): Event
    {
        return $this->eventQueryRepository->view($dto);
    }
}
