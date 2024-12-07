<?php

namespace Modules\Invitation\InvitationDelivery\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\User;

final class UserCanViewInvitationDeliveryCheck extends Check
{
    public function __construct(private readonly User $user)
    {
        //
    }

    //TODO Need to ste check  correctly
    public function execute(): CheckResponse
    {
        $canView = $this->user->can('view-invitation-delivery');

        return new CheckResponse(
            $canView,
            CheckFailure::create($this)
        );
    }
}
