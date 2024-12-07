<?php

namespace Modules\Event\Dto;

final class EventCreateRequestDto
{
    /**
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
        public readonly ?string $termsConditions,
        public readonly ?string $imageUrl,
        public readonly ?int $maxParticipants,
        public readonly ?int $ageLimit,
        public readonly ?string $eventType,
        public readonly ?string $streamingLink,
        public readonly ?array $tags,
        public readonly ?string $registrationDeadline,
        public readonly ?string $qrCode
    ) {
    }
}
