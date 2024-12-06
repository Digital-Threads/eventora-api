<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Dto;

final readonly class InvitationDeliveryCreateDto
{
    public function __construct(
        public int $invitationId,
        public string $recipientContact,
        public string $channel,
        public string $url,
        public string $status,
        public int $retryCount
    ) {
    }
}
