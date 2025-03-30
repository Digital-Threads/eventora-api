<?php

namespace Modules\Invitation\InvitationDelivery\Dto;

use Modules\Invitation\InvitationDelivery\Enums\InvitationResponseStatus;

final class InvitationDeliveryRespondDto
{
    public function __construct(
        public readonly int $deliveryId,
        public readonly string $response
    ) {}

    public function toEnum(): InvitationResponseStatus
    {
        return InvitationResponseStatus::from($this->response);
    }
}
