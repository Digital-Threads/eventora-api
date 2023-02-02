<?php

namespace Modules\AuthGoogle\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Modules\AuthGoogle\Dto\AuthGoogleLinkDto;
use Modules\AuthGoogle\Dto\AuthGoogleForgetDto;
use Infrastructure\Auth\Checks\UserHasFacebookCheck;
use Infrastructure\Auth\Checks\UserHasGoogleCheck;
use Infrastructure\Auth\Operators\Logical\OrCheck;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Infrastructure\Auth\Operators\Logical\NotCheck;
use Infrastructure\Auth\Checks\UserHasFacebookCheck;
use Infrastructure\Auth\Checks\UserHasPasswordCheck;
use Infrastructure\Auth\Operators\Identity\IsTrueCheck;

final class AuthGooglePolicy extends AbstractPolicy
{
    public function link(User $user, AuthGoogleLinkDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new NotCheck(new UserHasGoogleCheck($user)),
        ));
    }

    public function forget(User $user, AuthGoogleForgetDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasGoogleCheck($user),
            new OrCheck(
                new UserHasFacebookCheck($user),
                new AndCheck(
                    new UserHasFacebookCheck($user),
                    new UserHasPasswordCheck($user),
                ),
            ),
        ));
    }
}
