<?php

namespace Modules\AuthEmail\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Modules\AuthEmail\Dto\AuthEmailForgetDto;
use Infrastructure\Auth\Checks\UserHasEmailCheck;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Infrastructure\Auth\Operators\Logical\NotCheck;
use Infrastructure\Auth\Checks\UserVerifiedEmailCheck;
use Infrastructure\Auth\Operators\Identity\IsTrueCheck;
use Modules\AuthEmail\Dto\AuthEmailSendVerificationLinkDto;

final class AuthEmailPolicy extends AbstractPolicy
{
    public function sendVerificationLink(User $user, AuthEmailSendVerificationLinkDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasEmailCheck($user),
            new NotCheck(new UserVerifiedEmailCheck($user))
        ));
    }

    public function forget(User $user, AuthEmailForgetDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasEmailCheck($user),
        ));
    }
}
