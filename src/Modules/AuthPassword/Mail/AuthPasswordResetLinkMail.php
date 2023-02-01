<?php

namespace Modules\AuthPassword\Mail;

use Illuminate\Mail\Mailable;

final class AuthPasswordResetLinkMail extends Mailable
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $url,
    ) {
        //
    }

    public function build(): static
    {
        return $this
            ->subject(trans('messages.mail.auth_password_reset_link.subject'))
            ->markdown('email.auth-password.reset-link');
    }
}
