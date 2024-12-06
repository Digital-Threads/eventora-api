<?php

namespace Modules\Frontend\Dashboard\Event\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\Event;
use Modules\Frontend\Dashboard\Event\Dto\EventQueryRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventViewRequestDto;

interface EventQueryRepositoryInterface
{
    public function query(EventQueryRequestDto $dto): CursorPaginator;

    public function view(EventViewRequestDto $dto): Event;
}
