<?php

namespace Modules\Frontend\Dashboard\Event\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

final class UserCanCreateEventCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        //TODO Set usr event create role check
        $canCreate = (bool) $this->user->id;

        return new CheckResponse(
            $canCreate,
            CheckFailure::create($this)
        );
    }
}
