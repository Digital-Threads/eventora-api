<?php

namespace Modules\AuthTrustedDevice\Dto;

final class AuthTrustedDeviceViewDto
{
    public function __construct(
        public readonly int $deviceId,
    ) {
        //
    }
}
