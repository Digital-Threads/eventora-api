<?php

namespace Modules\Event\Http\Schemas;

use DateTime;
use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="EventSchema", type="object")
 */
final class EventSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public string $title,

        /** @OA\Property() */
        public ?string $description,

        /** @OA\Property() */
        public DateTime $eventDate,

        /** @OA\Property() */
        public ?string $location,

        /** @OA\Property() */
        public bool $isPublic,

        /** @OA\Property() */
        public ?int $organizerId,

        /** @OA\Property() */
        public ?int $categoryId,

        /** @OA\Property() */
        public ?int $templateId,

        /** @OA\Property() */
        public ?int $companyId,

        /** @OA\Property() */
        public ?string $termsConditions,

        /** @OA\Property() */
        public ?string $imageUrl,

        /** @OA\Property() */
        public ?int $maxParticipants,

        /** @OA\Property() */
        public ?int $ageLimit,

        /** @OA\Property() */
        public ?string $eventType,

        /** @OA\Property() */
        public ?string $streamingLink,

        /**
         * @OA\Property(
         *     type="array",
         *     @OA\Items(ref="#/components/schemas/TagSchema")
         * )
         */
        public ?array $tags,

        /** @OA\Property() */
        public ?DateTime $registrationDeadline,

        /** @OA\Property() */
        public ?string $qrCode
    ) {}
}
