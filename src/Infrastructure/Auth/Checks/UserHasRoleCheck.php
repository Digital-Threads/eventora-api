<?php

namespace Infrastructure\Auth\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

final class UserHasRoleCheck extends Check
{
    public function __construct(private readonly User $user, private readonly string $role)
    {
        //
    }

    public function execute(): CheckResponse
    {
        return new CheckResponse(
            $this->user->role->name === $this->role,
            CheckFailure::create($this),
        );
    }

}