<?php

namespace Modules\Invitation\InvitationDelivery\Dto;

final readonly class InvitationDeliverySendRequestDto
{
    public function __construct(
        public int $invitationId, // ID основного приглашения
        public array $recipients, // Список получателей (email или телефон)
        public string $channel, // Канал отправки
        public ?string $message // Персонализированное сообщение
    ) {
    }
}
