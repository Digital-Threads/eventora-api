<?php

namespace Modules\Invitation\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

final class UserCanCreateInvitationCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Логика проверки, может ли пользователь создавать приглашения
        $canCreate = $this->user->can('create-invitation');

        return new CheckResponse(
            $canCreate,
            CheckFailure::create($this)
        );
    }
}
