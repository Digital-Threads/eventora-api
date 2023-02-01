<?php

namespace Modules\AuthTrustedDevice\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceViewDto;
use Modules\AuthTrustedDevice\Dto\AuthTrustedDeviceDeleteDto;
use Modules\AuthTrustedDevice\Policies\Checks\AuthTrustedDeviceOwnershipCheck;

final class AuthTrustedDevicePolicy extends AbstractPolicy
{
    public function view(User $user, AuthTrustedDeviceViewDto $request): Response
    {
        return $this->check(new AndCheck(
            new AuthTrustedDeviceOwnershipCheck($user, $request->deviceId),
        ));
    }

    public function delete(User $user, AuthTrustedDeviceDeleteDto $request): Response
    {
        return $this->check(new AndCheck(
            new AuthTrustedDeviceOwnershipCheck($user, $request->deviceId),
        ));
    }
}
