<?php

namespace Modules\Invitation\Dto;

final class InvitationCreateRequestDto
{
    public function __construct(
        public readonly int $eventId, // ID события, к которому относится приглашение
        public readonly string $title, // Заголовок приглашения
        public readonly string $message, // Сообщение приглашения
        public readonly string $invitationLink // Ссылка на приглашение (генерируется для шаблона)
    ) {
    }
}
