<?php

namespace Modules\Event\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventViewRequestDto;
use Modules\Event\Dto\EventQueryRequestDto;
use Illuminate\Contracts\Pagination\CursorPaginator;

interface EventQueryRepositoryInterface
{
    public function query(EventQueryRequestDto $dto): CursorPaginator;

    public function view(EventViewRequestDto $dto): Event;
}
