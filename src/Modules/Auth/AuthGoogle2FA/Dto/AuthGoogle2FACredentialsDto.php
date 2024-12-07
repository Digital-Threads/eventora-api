<?php

namespace Modules\Auth\AuthGoogle2FA\Dto;

final class AuthGoogle2FACredentialsDto
{
    public function __construct(
        public readonly string $qr,
        public readonly string $secretKey,
        public readonly string $recoveryCode,
    ) {
        //
    }
}
