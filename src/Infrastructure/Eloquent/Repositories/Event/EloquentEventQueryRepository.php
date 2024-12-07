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
}
