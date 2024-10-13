<?php

namespace Modules\Company\Dto;

final class CompanyDeleteRequestDto
{
    /**
     * @param int $id
     */
    public function __construct(
        public readonly int $id
    ) {}
}
