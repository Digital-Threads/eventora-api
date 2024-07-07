<?php

namespace Infrastructure\Auth\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

final class UserHasGoogle2FAEnabledCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        return new CheckResponse(
            !is_null($this->user->google_2fa_enabled),
            CheckFailure::create($this),
        );
    }
}
