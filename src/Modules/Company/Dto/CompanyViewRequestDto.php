<?php

namespace Modules\Company\Dto;

final class CompanyViewRequestDto
{
    /**
     * @param int $id
     */
    public function __construct(
        public readonly int $id
    ) {}
}
