<?php

namespace Modules\Invitation\InvitationDelivery\Enums;

enum InvitationDeliveryChannel: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
    case WHATSAPP = 'whatsapp';
    case TELEGRAM = 'telegram';
    case VIBER = 'viber';
    case FACEBOOK = 'facebook';
}
