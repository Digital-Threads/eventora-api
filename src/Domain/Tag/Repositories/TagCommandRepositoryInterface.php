<?php

namespace Domain\Tag\Repositories;

use Modules\Tag\Dto\TagCreateRequestDto;
use Infrastructure\Eloquent\Models\Tag;

interface TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag;
}
