<?php

namespace Modules\Event\Dto;

final class EventUpdateRequestDto
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
     * @param  string|null  $imageUrl
     * @param  int|null  $maxParticipants
     * @param  int|null  $ageLimit
     * @param  string|null  $eventType
     * @param  string|null  $streamingLink
     * @param  array|null  $tags
     * @param  string|null  $registrationDeadline
     * @param  string|null  $qrCode
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
        public readonly ?string $termsConditions,
        public readonly ?string $imageUrl,
        public readonly ?int $maxParticipants,
        public readonly ?int $ageLimit,
        public readonly ?string $eventType,
        public readonly ?string $streamingLink,
        public readonly ?array $tags,
        public readonly ?string $registrationDeadline,
        public readonly ?string $qrCode
    ) {}
}
