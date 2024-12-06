<?php

namespace Modules\Frontend\Dashboard\Tag\Repositories;

use Infrastructure\Eloquent\Models\Tag;
use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;
use Modules\Frontend\Dashboard\Tag\Repositories\Interfaces\TagCommandRepositoryInterface;

class EloquentTagCommandRepository implements TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag
    {
        return Tag::create([
            'name' => $dto->name,
        ]);
    }
}
