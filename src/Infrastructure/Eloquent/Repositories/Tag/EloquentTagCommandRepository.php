<?php

namespace Infrastructure\Eloquent\Repositories\Tag;

use Modules\Tag\Dto\TagCreateRequestDto;
use Domain\Tag\Repositories\TagCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Tag;

class EloquentTagCommandRepository implements TagCommandRepositoryInterface
{
    public function create(TagCreateRequestDto $dto): Tag
    {
        return Tag::create([
            'name' => $dto->name,
        ]);
    }
}
