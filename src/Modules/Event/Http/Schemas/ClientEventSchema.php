<?php

namespace Modules\Event\Http\Schemas;

use DateTime;
use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="ClientEventSchema", type="object")
 */
final class ClientEventSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public string $title,

        /** @OA\Property() */
        public DateTime $eventDate,

        /** @OA\Property() */
        public ?string $location,

        /** @OA\Property() */
        public ?string $imageUrl,

        /**
         * @OA\Property(
         *     type="array",
         *     @OA\Items(type="string")
         * )
         */
        public ?array $tags
    ) {
    }
}
