<?php

namespace Domain\Event\Repositories;

use Modules\Event\Dto\EventQueryRequestDto;
use Modules\Event\Dto\EventViewRequestDto;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\Event;

interface EventQueryRepositoryInterface
{
    public function query(EventQueryRequestDto $dto): CursorPaginator;

    public function view(EventViewRequestDto $dto): Event;

    public function findPopular(array $popularEventIds,int $perPage, ?string $cursor): CursorPaginator;

    public function findBetweenDates(string $startDate, string $endDate, int $perPage, ?string $cursor): CursorPaginator;

    public function findIncoming(int $perPage, ?string $cursor): CursorPaginator;



}
