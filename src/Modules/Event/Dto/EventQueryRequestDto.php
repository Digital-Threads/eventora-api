<?php

namespace Modules\Event\Dto;

final class EventQueryRequestDto
{
    /**
     */
    public function __construct(
        public readonly ?int $categoryId,
        public readonly ?bool $isPublic,
        public readonly int $perPage,
        public readonly ?string $cursor,
        public readonly ?int $companyId
    ) {
    }
}
