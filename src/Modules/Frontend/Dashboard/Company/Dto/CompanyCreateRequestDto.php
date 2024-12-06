<?php

namespace Modules\Frontend\Dashboard\Company\Dto;

final readonly class CompanyCreateRequestDto
{
    /**
     */
    public function __construct(
        public string $name,
        public string $slug,
        public ?string $description = null,
        public ?string $avatarUrl = null,
        public ?string $websiteUrl = null,
        public ?string $activityDescription = null
    ) {
    }
}
