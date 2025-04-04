<?php

namespace Modules\Event\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;
use Infrastructure\Eloquent\Models\Event;
use Infrastructure\Eloquent\Models\User;

final class UserCanDeleteEventCheck extends Check
{
    public function __construct(private readonly User $user, private readonly Event $event)
    {
        //
    }

    public function execute(): CheckResponse
    {
        $canDelete = $this->user->id === $this->event->organizer_id;


        return new CheckResponse(
            $canDelete,
            CheckFailure::create($this)
        );
    }
}
