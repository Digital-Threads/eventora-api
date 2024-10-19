<?php

namespace Modules\Invitation\InvitationDelivery\Checks;

use App\Models\User;
use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\InvitationDelivery;

final class UserCanViewInvitationDeliveryCheck extends Check
{
    public function __construct(private readonly User $user, private readonly InvitationDelivery $invitationDelivery)
    {
        //
    }

    public function execute(): CheckResponse
    {
        // Логика проверки, может ли пользователь просматривать доставленные приглашения
        $canView = $this->user->can('view-invitation-delivery') || $this->user->id === $this->invitationDelivery->recipient_contact;

        return new CheckResponse(
            $canView,
            CheckFailure::create($this)
        );
    }
}
