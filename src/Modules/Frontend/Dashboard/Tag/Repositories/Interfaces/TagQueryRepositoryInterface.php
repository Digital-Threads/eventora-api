<?php

namespace Modules\Frontend\Dashboard\Tag\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Tag;

interface TagQueryRepositoryInterface
{
    public function find(int $id): ?Tag;

    public function getAll(): Collection;

    public function search(string $query): Collection;
}
