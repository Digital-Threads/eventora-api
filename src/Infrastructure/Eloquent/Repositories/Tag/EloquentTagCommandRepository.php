<?php

namespace Infrastructure\Eloquent\Repositories\Tag;

use Domain\Tag\Repositories\TagCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Tag;
use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;

class EloquentTagCommandRepository implements TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag
    {
        return Tag::create([
            'name' => $dto->name,
        ]);
    }
}
