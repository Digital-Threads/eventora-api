<?php

namespace Modules\Frontend\Dashboard\Tag\Services;

use Domain\Tag\Repositories\TagCommandRepositoryInterface;
use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;

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
