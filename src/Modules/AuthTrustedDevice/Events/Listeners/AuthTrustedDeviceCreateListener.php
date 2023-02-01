<?php

namespace Modules\AuthTrustedDevice\Events\Listeners;

use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceCreateDto;
use Modules\AuthTrustedDevice\Services\AuthTrustedDeviceCommandService;

final class AuthTrustedDeviceCreateListener
{
    public function __construct(
        private readonly AuthTrustedDeviceCommandService $service,
    ) {
        //
    }

    public function handle(array $payload): void
    {
        $this->service->create(new AuthTrustedDeviceCreateDto(
            $payload['userId'],
            $payload['ip'],
            $payload['userAgent'],
        ));
    }
}
