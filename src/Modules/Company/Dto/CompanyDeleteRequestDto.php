<?php

namespace Modules\Company\Dto;

final class CompanyDeleteRequestDto
{
    /**
     */
    public function __construct(
        public readonly int $id
    ) {
    }
}
