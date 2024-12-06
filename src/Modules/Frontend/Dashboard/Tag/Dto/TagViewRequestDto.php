<?php

namespace Modules\Frontend\Dashboard\Tag\Dto;

final class TagViewRequestDto
{
    public function __construct(
        public readonly int $id
    ) {
        //
    }
}
