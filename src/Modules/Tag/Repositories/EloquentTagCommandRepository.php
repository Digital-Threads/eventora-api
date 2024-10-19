<?php

namespace Modules\Tag\Repositories;

use Infrastructure\Eloquent\Models\Tag;
use Modules\Tag\Dto\TagCreateRequestDto;
use Modules\Tag\Repositories\Interfaces\TagCommandRepositoryInterface;

class EloquentTagCommandRepository implements TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag
    {
        return Tag::create([
            'name' => $dto->name,
        ]);
    }
}
