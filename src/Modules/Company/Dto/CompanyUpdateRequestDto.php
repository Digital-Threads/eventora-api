<?php

namespace Modules\Company\Dto;

final class CompanyUpdateRequestDto
{
    /**
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $slug,
        public readonly ?string $description,
        public readonly ?string $avatarUrl,
        public readonly ?string $websiteUrl,
        public readonly ?string $activityDescription
    ) {
    }
}
