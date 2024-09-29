<?php

namespace Modules\Event\Dto;

final class EventCreateDto
{
    /**
     * @param  string  $title
     * @param  string|null  $description
     * @param  string  $eventDate
     * @param  string|null  $location
     * @param  bool  $isPublic
     * @param  int  $organizerId
     * @param  int|null  $categoryId
     * @param  int|null  $templateId
     * @param  int|null  $companyId
     * @param  string|null  $termsConditions
     */
    public function __construct(
        public readonly string $title,
        public readonly ?string $description,
        public readonly string $eventDate,
        public readonly ?string $location,
        public readonly bool $isPublic,
        public readonly int $organizerId,
        public readonly ?int $categoryId,
        public readonly ?int $templateId,
        public readonly ?int $companyId,
        public readonly ?string $termsConditions
    ) {}
}