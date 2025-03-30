<?php

namespace Domain\InvitationDelivery\Events;

use Infrastructure\Eloquent\Models\InvitationDelivery;

final class InvitationConsidering
{
    public function __construct(
        public readonly InvitationDelivery $delivery
    ) {}
}
