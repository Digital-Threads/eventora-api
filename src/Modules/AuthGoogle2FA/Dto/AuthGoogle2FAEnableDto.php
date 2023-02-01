<?php

namespace Modules\AuthGoogle2FA\Dto;

final class AuthGoogle2FAEnableDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $ip,
        public readonly ?string $userAgent,
        public readonly bool $trusted,
    ) {
        //
    }
}
