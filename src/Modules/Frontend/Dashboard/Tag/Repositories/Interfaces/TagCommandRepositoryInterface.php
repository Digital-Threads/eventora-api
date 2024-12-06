<?php

namespace Modules\Frontend\Dashboard\Tag\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Tag;
use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;

interface TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag;
}
