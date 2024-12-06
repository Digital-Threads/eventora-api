<?php

namespace Modules\Frontend\Dashboard\Invitation\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="InvitationSchema", type="object")
 */
final class InvitationSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public int $eventId,

        /** @OA\Property() */
        public string $title,

        /** @OA\Property() */
        public ?string $message,

        /** @OA\Property() */
        public string $invitationLink,

        /** @OA\Property() */
        public string $createdAt,

        /** @OA\Property() */
        public string $updatedAt
    ) {
    }
}
