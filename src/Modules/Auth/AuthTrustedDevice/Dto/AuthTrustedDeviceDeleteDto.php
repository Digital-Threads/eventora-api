<?php

namespace Modules\Auth\AuthTrustedDevice\Dto;

final class AuthTrustedDeviceDeleteDto
{
    public function __construct(
        public readonly int $deviceId,
    ) {
        //
    }
}
