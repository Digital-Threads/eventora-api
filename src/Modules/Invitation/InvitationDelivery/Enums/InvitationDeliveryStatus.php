<?php

namespace Modules\Invitation\InvitationDelivery\Enums;

enum InvitationDeliveryStatus: string
{
    case PENDING = 'pending';
    case SENT = 'sent';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
}
