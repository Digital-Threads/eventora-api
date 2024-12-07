<?php

namespace Modules\Tag\Services;

use Modules\Tag\Dto\TagSearchRequestDto;
use Modules\Tag\Dto\TagViewRequestDto;
use Domain\Tag\Repositories\TagQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Tag;

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
