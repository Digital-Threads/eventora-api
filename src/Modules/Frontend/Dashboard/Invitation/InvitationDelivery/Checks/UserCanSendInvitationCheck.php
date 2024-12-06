<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

final class UserCanSendInvitationCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    public function execute(): CheckResponse
    {
        $canSend = $this->user->can('send-invitation');

        return new CheckResponse(
            $canSend,
            CheckFailure::create($this)
        );
    }
}
