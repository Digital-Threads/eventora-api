<?php

namespace Modules\Event\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Modules\Event\Dto\EventQueryRequestDto;
use Modules\Event\Dto\EventViewRequestDto;
use Infrastructure\Eloquent\Models\Event;

interface EventQueryRepositoryInterface
{
    public function query(EventQueryRequestDto $dto): CursorPaginator;

    public function view(EventViewRequestDto $dto): Event;
}
