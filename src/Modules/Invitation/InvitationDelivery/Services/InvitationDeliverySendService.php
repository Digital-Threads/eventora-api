<?php

namespace Modules\Invitation\InvitationDelivery\Services;

use Modules\Invitation\InvitationDelivery\Strategies\EmailInvitationChannelStrategy;
use Modules\Invitation\InvitationDelivery\Strategies\InvitationChannelStrategyInterface;
use Infrastructure\Eloquent\Models\InvitationDelivery;

class InvitationDeliverySendService
{
    protected array $channels;

    public function __construct()
    {
        // Инициализируем стратегии
        $this->channels = [
            'email' => new EmailInvitationChannelStrategy(),
        ];
    }

    public function sendInvitations(array $deliveries): void
    {
        foreach ($deliveries as $delivery) {
            $channel = $delivery->channel;
            $recipientContact = $delivery->recipient_contact;
            $message = "Your invitation message"; // Можно настроить сообщение
            $invitationLink = "Your invitation link"; // Настройка ссылки

            // Отправляем через соответствующий канал
            if (array_key_exists($channel, $this->channels)) {
                $success = $this->channels[$channel]->send($recipientContact, $message, $invitationLink);

                // Обновляем статус
                $delivery->status = $success ? 'sent' : 'failed';
                $delivery->save(); // Сохранение статуса
            }
        }
    }
}
