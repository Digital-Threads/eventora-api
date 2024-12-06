<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Strategies;

interface InvitationChannelStrategyInterface
{
    public function send(string $recipientContact, string $message, string $invitationLink): bool;
}
