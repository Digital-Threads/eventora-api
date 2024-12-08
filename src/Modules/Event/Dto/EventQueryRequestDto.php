<?php

namespace Modules\Event\Dto;


final class EventQueryRequestDto
{
    public function __construct(
        public readonly ?int    $categoryId = null,
        public readonly ?bool   $isPublic = true,
        public readonly int     $perPage = 10,
        public readonly ?string $cursor = null,
        public readonly ?int    $companyId = null,
        public readonly ?string $orderBy = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null
    ) {}
}
