<?php

namespace Modules\Invitation\Dto;

final class InvitationCreateDto
{
    public function __construct(
        public readonly int $eventId,
        public readonly ?int $userId,
        public readonly string $recipientContact, // Email или телефон
        public readonly string $channel, // Канал отправки
        public readonly ?string $message,
        public readonly string $invitationLink,
        public readonly string $status
    ) {}
}