<?php

namespace Modules\Frontend\Dashboard\Company\Dto;

final class CompanyDeleteRequestDto
{
    /**
     */
    public function __construct(
        public readonly int $id
    ) {
    }
}
