<?php

namespace Modules\Tag\Dto;

final class TagSearchRequestDto
{
    public function __construct(
        public readonly string $query
    ) {
        //
    }
}
