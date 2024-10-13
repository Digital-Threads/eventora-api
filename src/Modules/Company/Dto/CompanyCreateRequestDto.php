<?php

namespace Modules\Company\Dto;


final readonly class CompanyCreateRequestDto
{
    /**
     * @param string      $name
     * @param string      $slug
     * @param string|null $description
     * @param string|null $avatarUrl
     * @param string|null $websiteUrl
     * @param string|null $activityDescription
     */
    public function __construct(
        public string  $name,
        public string  $slug,
        public ?string $description = null,
        public ?string $avatarUrl = null,
        public ?string $websiteUrl = null,
        public ?string $activityDescription = null
    ) {}
}
