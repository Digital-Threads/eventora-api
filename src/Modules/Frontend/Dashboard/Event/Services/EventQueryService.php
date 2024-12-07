<?php

namespace Modules\Frontend\Dashboard\Event\Services;

use Domain\Event\Repositories\EventQueryRepositoryInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\Event;
use Modules\Frontend\Dashboard\Event\Dto\EventQueryRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventViewRequestDto;

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
