<?php

namespace Modules\AuthEmail\Mail;

use Illuminate\Mail\Mailable;

final class AuthEmailVerificationLinkMail extends Mailable
{
    public function __construct(
        public readonly ?string $firstName,
        public readonly ?string $lastName,
        public readonly string $url,
    ) {
        //
    }

    public function build(): static
    {
        return $this
            ->subject(trans('messages.mail.auth_email_verification.subject'))
            ->markdown('email.auth-email.email-verification-link');
    }
}
