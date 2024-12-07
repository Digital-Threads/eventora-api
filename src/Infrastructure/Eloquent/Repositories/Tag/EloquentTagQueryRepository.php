<?php

namespace Infrastructure\Eloquent\Repositories\Tag;

use Domain\Tag\Repositories\TagQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Tag;

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
