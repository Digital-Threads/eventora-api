<?php

namespace Modules\EventCategory\Services;

use Domain\EventCategory\Repositories\EventCategoryQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EventCategoryQueryService
{

    public function __construct(private EventCategoryQueryRepositoryInterface $categoryQueryRepository) {}

    public function query(): Collection
    {
        return $this->categoryQueryRepository->getAll();
    }
}
