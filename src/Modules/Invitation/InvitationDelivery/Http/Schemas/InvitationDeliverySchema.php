<?php

namespace Modules\Invitation\InvitationDelivery\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="InvitationDeliverySchema", type="object")
 */
final class InvitationDeliverySchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public int $invitationId,

        /** @OA\Property() */
        public string $recipientContact,

        /** @OA\Property(enum={"email", "sms", "whatsapp", "telegram", "viber", "facebook"}) */
        public string $channel,

        /** @OA\Property(enum={"pending", "sent", "delivered", "failed"}) */
        public string $status,

        /** @OA\Property() */
        public int $retryCount,

        /** @OA\Property() */
        public string $createdAt,

        /** @OA\Property() */
        public string $updatedAt
    ) {
    }
}
