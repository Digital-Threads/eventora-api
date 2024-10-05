<?php

namespace Modules\Invitation\Dto;

final class InvitationUpdateDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $recipientContact,
        public readonly string $channel,
        public readonly ?string $message,
        public readonly string $invitationLink,
        public readonly string $status
    ) {}
}