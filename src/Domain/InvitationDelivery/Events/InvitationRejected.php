<?php

namespace Domain\InvitationDelivery\Events;

use Infrastructure\Eloquent\Models\InvitationDelivery;

final class InvitationRejected
{
    public function __construct(
        public readonly InvitationDelivery $delivery
    ) {}
}
