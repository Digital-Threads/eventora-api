<?php

namespace Infrastructure\Eloquent\Repositories\EventCategory;

use Domain\EventCategory\Repositories\EventCategoryQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\EventCategory;

class EloquentEventCategoryQueryRepository implements EventCategoryQueryRepositoryInterface{
    public function getAll(): Collection
    {
        return EventCategory::query()->get();
    }
}
