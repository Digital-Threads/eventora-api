<?php

namespace Modules\Tag\Services;

use Modules\Tag\Dto\TagViewRequestDto;
use Infrastructure\Eloquent\Models\Tag;
use Modules\Tag\Dto\TagSearchRequestDto;
use Illuminate\Database\Eloquent\Collection;
use Modules\Tag\Repositories\Interfaces\TagQueryRepositoryInterface;

final class TagQueryService
{
    public function __construct(
        private readonly TagQueryRepositoryInterface $tagRepository,
    ) {
        //
    }

    public function search(TagSearchRequestDto $dto): Collection
    {
        return $this->tagRepository->search($dto->query);
    }

    public function getAll(): Collection
    {
        return $this->tagRepository->getAll();
    }

    public function find(TagViewRequestDto $dto): Tag
    {
        return $this->tagRepository->find($dto->id);
    }
}
