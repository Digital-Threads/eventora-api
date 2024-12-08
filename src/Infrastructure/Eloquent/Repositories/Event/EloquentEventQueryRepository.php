<?php

namespace Infrastructure\Eloquent\Repositories\Event;

use Modules\Event\Dto\EventQueryRequestDto;
use Modules\Event\Dto\EventViewRequestDto;
use Domain\Event\Repositories\EventQueryRepositoryInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Infrastructure\Eloquent\Models\Event;

class EloquentEventQueryRepository implements EventQueryRepositoryInterface
{
    public function query(EventQueryRequestDto $dto): CursorPaginator
    {
        return Event::query()
            ->when($dto->categoryId, fn ($query) => $query->where('category_id', $dto->categoryId))
            ->when($dto->isPublic, fn ($query) => $query->where('is_public', $dto->isPublic))
            ->when($dto->companyId, fn ($query) => $query->where('company_id', $dto->companyId))
            ->cursorPaginate($dto->perPage, cursor: $dto->cursor);
    }

    public function view(EventViewRequestDto $dto): Event
    {
        return Event::query()->findOrFail($dto->id);
    }



    public function findPopular(array $popularEventIds,int $perPage, ?string $cursor): CursorPaginator
    {
        return Event::query()
            ->whereIn('id', $popularEventIds)
            ->cursorPaginate($perPage, cursor: $cursor);
    }

    public function findBetweenDates(string $startDate, string $endDate, int $perPage, ?string $cursor): CursorPaginator
    {
        return Event::query()
            ->where('is_public', true)
            ->whereBetween('event_date', [$startDate, $endDate])
            ->cursorPaginate($perPage, cursor: $cursor);
    }

    public function findIncoming(int $perPage, ?string $cursor): CursorPaginator
    {
        return Event::query()
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->cursorPaginate($perPage, cursor: $cursor);
    }
}
