<?php

namespace Modules\Frontend\Dashboard\Tag\Services;

use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;
use Modules\Frontend\Dashboard\Tag\Repositories\Interfaces\TagCommandRepositoryInterface;

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
