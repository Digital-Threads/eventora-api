<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Strategies;

use Exception;
use Illuminate\Support\Facades\Mail;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Mail\InvitationMail;

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
