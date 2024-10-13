<?php

namespace Modules\Company\Dto;

final class CompanyUpdateRequestDto
{
    /**
     * @param int         $id
     * @param string|null $name
     * @param string|null $slug
     * @param string|null $description
     * @param string|null $avatarUrl
     * @param string|null $websiteUrl
     * @param string|null $activityDescription
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $slug,
        public readonly ?string $description,
        public readonly ?string $avatarUrl,
        public readonly ?string $websiteUrl,
        public readonly ?string $activityDescription
    ) {}
}
