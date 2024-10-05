<?php

namespace Modules\Invitation\Dto;

final class InvitationQueryRequestDto
{
    public function __construct(
        public readonly int $eventId // Получаем все приглашения для конкретного события
    ) {}
}