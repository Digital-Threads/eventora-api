<?php

namespace Domain\EventCategory\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface EventCategoryQueryRepositoryInterface
{
    public function getAll(): Collection;

}
