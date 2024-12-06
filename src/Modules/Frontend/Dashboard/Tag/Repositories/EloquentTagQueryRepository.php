<?php

namespace Modules\Frontend\Dashboard\Tag\Repositories;

use Infrastructure\Eloquent\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Modules\Frontend\Dashboard\Tag\Repositories\Interfaces\TagQueryRepositoryInterface;

class EloquentTagQueryRepository implements TagQueryRepositoryInterface
{
    public function find(int $id): ?Tag
    {
        return Tag::find($id);
    }

    public function getAll(): Collection
    {
        return Tag::all();
    }

    public function search(string $query): Collection // Реализация метода для поиска
    {
        return Tag::where('name', 'like', "%{$query}%")->get();
    }
}
