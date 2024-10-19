<?php

namespace Modules\Invitation\InvitationDelivery\Checks;

use App\Models\User;
use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;

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
