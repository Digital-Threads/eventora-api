<?php

namespace Modules\AuthProfile\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Modules\AuthProfile\Dto\AuthProfileViewDto;
use Modules\AuthProfile\Dto\AuthProfileUpdateDto;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Infrastructure\Auth\Operators\Identity\IsTrueCheck;

final class AuthProfilePolicy extends AbstractPolicy
{
    public function view(User $user, AuthProfileViewDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
        ));
    }

    public function update(User $user, AuthProfileUpdateDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
        ));
    }
}
