<?php

namespace Modules\Company\Dto;

final class CompanyViewRequestDto
{
    /**
     */
    public function __construct(
        public readonly int $id
    ) {
    }
}
