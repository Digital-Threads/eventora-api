<?php

namespace Modules\Frontend\Dashboard\Tag\Services;

use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Tag;
use Modules\Frontend\Dashboard\Tag\Dto\TagSearchRequestDto;
use Modules\Frontend\Dashboard\Tag\Dto\TagViewRequestDto;
use Modules\Frontend\Dashboard\Tag\Repositories\Interfaces\TagQueryRepositoryInterface;

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
