<?php

namespace Modules\AuthTrustedDevice\Policies\Checks;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractCheck;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\UserTrustedDevice;

final class AuthTrustedDeviceOwnershipCheck extends AbstractCheck
{
    public function __construct(
        private readonly User $user,
        private readonly int $deviceId,
    ) {
        //
    }

    public function execute(): Response
    {
        return new Response(
            UserTrustedDevice::query()
                ->where('user_id', $this->user->id)
                ->where('id', $this->deviceId)
                ->exists()
        );
    }
}
