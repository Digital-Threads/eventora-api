<?php

namespace Modules\Auth\AuthTrustedDevice\Dto;

final class AuthTrustedDeviceCreateDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $ip,
        public readonly ?string $userAgent,
    ) {
        //
    }
}
