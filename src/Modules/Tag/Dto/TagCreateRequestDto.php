<?php

namespace Modules\Tag\Dto;

final class TagCreateRequestDto
{
    public function __construct(
        public readonly string $name
    ) {
        //
    }
}



