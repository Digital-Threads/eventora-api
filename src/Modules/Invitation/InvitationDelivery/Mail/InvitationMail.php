<?php

namespace Modules\Invitation\InvitationDelivery\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $message;
    public string $invitationLink;

    public function __construct(string $message, string $invitationLink)
    {
        $this->message = $message;
        $this->invitationLink = $invitationLink;
    }

    public function build()
    {
        return $this
            ->subject('You are invited!')
            ->view('emails.invitation')
            ->with([
                'message' => $this->message,
                'invitationLink' => $this->invitationLink,
            ]);
    }
}
