<?php

namespace Modules\Auth\AuthGoogle2FA\Dto;

final class AuthGoogle2FADisableDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
