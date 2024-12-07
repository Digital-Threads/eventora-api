<?php

namespace Domain\Tag\Repositories;

use Infrastructure\Eloquent\Models\Tag;
use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;

interface TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag;
}
