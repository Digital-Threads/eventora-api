<?php

namespace Modules\Example\Dto;

final class QueryRequestDto
{
    public function __construct(
        public readonly int $perPage,
        public readonly ?string $cursor,
    ) {
        //
    }
}
