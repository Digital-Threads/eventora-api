<?php

namespace Modules\Invitation\Dispatchers;

use Modules\Invitation\InvitationDelivery\Strategies\EmailInvitationChannelStrategy;

class InvitationSendDispatcher
{
    protected array $channels;

    public function __construct()
    {
        // Здесь можно добавить другие стратегии (SMS, WhatsApp и т.д.)
        $this->channels = [
            'email' => new EmailInvitationChannelStrategy(),
            // 'sms' => new SmsInvitationChannelStrategy(),
            // 'telegram' => new TelegramInvitationChannelStrategy(),
        ];
    }

    /**
     * @throws \Exception
     */
    public function sendInvitation(string $channel, string $recipientContact, string $message, string $invitationLink): bool
    {
        if (array_key_exists($channel, $this->channels)) {
            return $this->channels[$channel]->send($recipientContact, $message, $invitationLink);
        }

        throw new \Exception("Unsupported invitation channel: {$channel}");
    }
}
