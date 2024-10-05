<?php

namespace Modules\Invitation\Http\Schemas;

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
        public ?int $userId,

        /** @OA\Property() */
        public string $recipientContact,

        /** @OA\Property(enum={"email", "sms", "whatsapp", "telegram", "viber", "facebook"}) */
        public string $channel,

        /** @OA\Property() */
        public ?string $message,

        /** @OA\Property() */
        public string $invitationLink,

        /** @OA\Property(enum={"pending", "sent", "delivered", "failed"}) */
        public string $status,

        /** @OA\Property() */
        public string $createdAt,

        /** @OA\Property() */
        public string $updatedAt
    ) {}
}