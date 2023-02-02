<?php

namespace Modules\AuthFacebook\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Auth\Checks\UserHasFacebookCheck;
use Modules\AuthFacebook\Dto\AuthFacebookLinkDto;
use Infrastructure\Auth\Checks\UserHasGoogleCheck;
use Infrastructure\Auth\Operators\Logical\OrCheck;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Infrastructure\Auth\Operators\Logical\NotCheck;
use Modules\AuthFacebook\Dto\AuthFacebookForgetDto;
use Infrastructure\Auth\Checks\UserHasFacebookCheck;
use Infrastructure\Auth\Checks\UserHasPasswordCheck;
use Infrastructure\Auth\Operators\Identity\IsTrueCheck;

final class AuthFacebookPolicy extends AbstractPolicy
{
    public function link(User $user, AuthFacebookLinkDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new NotCheck(new UserHasFacebookCheck($user)),
        ));
    }

    public function forget(User $user, AuthFacebookForgetDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasFacebookCheck($user),
            new OrCheck(
                new UserHasGoogleCheck($user),
                new AndCheck(
                    new UserHasFacebookCheck($user),
                    new UserHasPasswordCheck($user),
                ),
            ),
        ));
    }
}
