<?php

namespace Domain\InvitationDelivery\Exception;

use Exception;

final class AlreadyRespondedException extends Exception
{
    protected $message = 'Invitation has already been responded to.';
}
