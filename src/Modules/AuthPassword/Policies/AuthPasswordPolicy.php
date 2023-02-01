<?php

namespace Modules\AuthPassword\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Modules\AuthPassword\Dto\AuthPasswordForgetDto;
use Infrastructure\Auth\Checks\UserHasPasswordCheck;
use Infrastructure\Auth\Operators\Identity\IsTrueCheck;

final class AuthPasswordPolicy extends AbstractPolicy
{
    public function forget(User $user, AuthPasswordForgetDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasPasswordCheck($user),
        ));
    }
}
