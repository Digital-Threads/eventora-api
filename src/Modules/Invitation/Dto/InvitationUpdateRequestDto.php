<?php

namespace Modules\Invitation\Dto;

final class InvitationUpdateRequestDto
{
    public function __construct(
        public readonly int $id, // ID приглашения
        public readonly int $eventId, // ID события
        public readonly ?string $title, // Заголовок приглашения
        public readonly ?string $message, // Сообщение приглашения
        public readonly ?string $invitationLink // Ссылка на приглашение (если нужно обновить)
    ) {}
}
