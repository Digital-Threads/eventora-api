<?php

namespace Modules\Auth\AuthGoogle2FA\Dto;

final class AuthGoogle2FAForgetDto
{
    public function __construct(
        public readonly int $userId,
    ) {
        //
    }
}
