<?php

namespace Modules\Event\Dto;

final class EventUpdateDto
{
    /**
     * @param  int  $id
     * @param  string|null  $title
     * @param  string|null  $description
     * @param  string|null  $eventDate
     * @param  string|null  $location
     * @param  bool|null  $isPublic
     * @param  int|null  $categoryId
     * @param  int|null  $templateId
     * @param  int|null  $companyId
     * @param  string|null  $termsConditions
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $eventDate,
        public readonly ?string $location,
        public readonly ?bool $isPublic,
        public readonly ?int $categoryId,
        public readonly ?int $templateId,
        public readonly ?int $companyId,
        public readonly ?string $termsConditions
    ) {}
}