<?php

namespace Modules\Invitation\Dto;

final class InvitationViewRequestDto
{
    public function __construct(
        public readonly int $id // ID конкретного приглашения для просмотра
    ) {
    }
}
