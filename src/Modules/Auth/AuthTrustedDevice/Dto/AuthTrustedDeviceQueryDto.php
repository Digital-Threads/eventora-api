<?php

namespace Modules\Auth\AuthTrustedDevice\Dto;

final class AuthTrustedDeviceQueryDto
{
    public function __construct(
        public readonly int $userId,
        public readonly ?string $cursor,
    ) {
        //
    }
}
