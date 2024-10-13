<?php

namespace Modules\Tag\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Tag;
use Modules\Tag\Dto\TagCreateRequestDto;

interface TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag;
}
