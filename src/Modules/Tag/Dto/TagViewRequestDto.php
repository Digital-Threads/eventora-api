<?php

namespace Modules\Tag\Dto;

final class TagViewRequestDto
{
    public function __construct(
        public readonly int $id
    ) {
        //
    }
}
