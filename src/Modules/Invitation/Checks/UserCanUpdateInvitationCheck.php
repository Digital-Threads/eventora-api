<?php

namespace Modules\Invitation\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\Invitation;

final class UserCanUpdateInvitationCheck extends Check
{
    public function __construct(private readonly User $user, private readonly Invitation $invitation)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Логика проверки, может ли пользователь обновить приглашение
        $canUpdate = $this->user->id === $this->invitation->user_id;

        return new CheckResponse(
            $canUpdate,
            CheckFailure::create($this)
        );
    }
}
