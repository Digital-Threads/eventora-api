<?php

namespace Modules\Event\Repositories;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Dto\EventViewRequestDto;
use Modules\Event\Dto\EventQueryRequestDto;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Modules\Event\Repositories\Interfaces\EventQueryRepositoryInterface;

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
        return Event::findOrFail($dto->id);
    }
}
