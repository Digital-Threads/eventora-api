<?php

namespace Modules\Invitation\InvitationDelivery\Enums;

enum InvitationResponseStatus: string
{
    case NONE = 'none';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case CONSIDERING = 'considering';
}
