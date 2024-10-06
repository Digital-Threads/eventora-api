<?php

namespace Modules\Event\Dto;

final class EventQueryRequestDto
{
    /**
     * @param  int|null  $categoryId
     * @param  bool|null  $isPublic
     * @param  int  $perPage
     * @param  string|null  $cursor
     * @param  int|null  $companyId
     */
    public function __construct(
        public readonly ?int $categoryId,
        public readonly ?bool $isPublic,
        public readonly int $perPage,
        public readonly ?string $cursor,
        public readonly ?int $companyId
    ) {}
}
