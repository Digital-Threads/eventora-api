<?php

namespace Modules\Invitation\InvitationDelivery\Strategies;

use Modules\Invitation\InvitationDelivery\Mail\InvitationMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class EmailInvitationChannelStrategy implements InvitationChannelStrategyInterface
{
    public function send(string $recipientContact, string $message, string $invitationLink): bool
    {
        try {
            Mail::to($recipientContact)->send(new InvitationMail($message, $invitationLink));

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
