<?php

namespace Modules\AuthGoogle2FA\Policies;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractPolicy;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Auth\Checks\UserHasEmailCheck;
use Infrastructure\Auth\Operators\Logical\AndCheck;
use Infrastructure\Auth\Operators\Logical\NotCheck;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAIssueDto;
use Infrastructure\Auth\Checks\UserHasGoogle2FACheck;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAEnableDto;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAForgetDto;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FADisableDto;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FAReissueDto;
use Infrastructure\Auth\Operators\Identity\IsTrueCheck;
use Infrastructure\Auth\Checks\UserHasGoogle2FAEnabledCheck;

final class AuthGoogle2FAPolicy extends AbstractPolicy
{
    public function issue(User $user, AuthGoogle2FAIssueDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasEmailCheck($user),
            new NotCheck(new UserHasGoogle2FACheck($user)),
        ));
    }

    public function reissue(User $user, AuthGoogle2FAReissueDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasGoogle2FACheck($user),
        ));
    }

    public function enable(User $user, AuthGoogle2FAEnableDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasGoogle2FACheck($user),
            new NotCheck(new UserHasGoogle2FAEnabledCheck($user)),
        ));
    }

    public function disable(User $user, AuthGoogle2FADisableDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasGoogle2FACheck($user),
            new UserHasGoogle2FAEnabledCheck($user),
        ));
    }

    public function forget(User $user, AuthGoogle2FAForgetDto $request): Response
    {
        return $this->check(new AndCheck(
            new IsTrueCheck($user->id === $request->userId),
            new UserHasGoogle2FACheck($user),
        ));
    }
}
