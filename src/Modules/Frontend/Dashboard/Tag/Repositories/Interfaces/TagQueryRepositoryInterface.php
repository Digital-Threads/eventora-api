<?php

namespace Modules\Frontend\Dashboard\Tag\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

interface TagQueryRepositoryInterface
{
    public function find(int $id): ?Tag;

    public function getAll(): Collection;

    public function search(string $query): Collection;
}
