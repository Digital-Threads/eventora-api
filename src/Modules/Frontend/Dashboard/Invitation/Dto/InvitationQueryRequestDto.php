<?php

namespace Modules\Frontend\Dashboard\Invitation\Dto;

final class InvitationQueryRequestDto
{
    public function __construct(
        public readonly int $eventId // ID события для фильтрации приглашений
    ) {
    }
}
