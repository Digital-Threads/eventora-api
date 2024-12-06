<?php

namespace Modules\Frontend\Dashboard\Event\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Event;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Modules\Frontend\Dashboard\Event\Dto\EventViewRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventQueryRequestDto;

interface EventQueryRepositoryInterface
{
    public function query(EventQueryRequestDto $dto): CursorPaginator;

    public function view(EventViewRequestDto $dto): Event;
}
