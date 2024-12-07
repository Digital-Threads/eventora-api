<?php

namespace Modules\Event\Services;

use Modules\Event\Dto\EventQueryRequestDto;
use Modules\Event\Dto\EventViewRequestDto;
use Domain\Event\Repositories\EventQueryRepositoryInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\Event;

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
