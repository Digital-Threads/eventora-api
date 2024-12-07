<?php

namespace Modules\Auth\AuthTrustedDevice\Dto;

final class AuthTrustedDeviceViewDto
{
    public function __construct(
        public readonly int $deviceId,
    ) {
        //
    }
}
