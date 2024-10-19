<?php

namespace Modules\Invitation\InvitationDelivery\Dto;

final readonly class InvitationDeliveryViewRequestDto
{
    public function __construct(
        public int $id // ID конкретной записи о доставке приглашения
    ) {
    }
}
