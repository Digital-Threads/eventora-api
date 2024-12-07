<?php

namespace Modules\Tag\Services;

use Modules\Tag\Dto\TagCreateRequestDto;
use Domain\Tag\Repositories\TagCommandRepositoryInterface;

final class TagCommandService
{
    public function __construct(
        private readonly TagCommandRepositoryInterface $tagRepository,
    ) {
        //
    }

    public function create(TagCreateRequestDto $dto): void
    {
        $this->tagRepository->create($dto);
    }
}
