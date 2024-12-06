<?php

namespace Modules\Frontend\Dashboard\Tag\Dto;

final class TagSearchRequestDto
{
    public function __construct(
        public readonly string $query
    ) {
        //
    }
}
