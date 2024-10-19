<?php

namespace Modules\Invitation\InvitationDelivery\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Invitation\InvitationDelivery\Enums\InvitationDeliveryStatus;
use Modules\Invitation\InvitationDelivery\Strategies\InvitationChannelStrategyInterface;

class InvitationDeliverySendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected InvitationDelivery $delivery;
    protected InvitationChannelStrategyInterface $strategy;

    public function __construct(InvitationDelivery $delivery, InvitationChannelStrategyInterface $strategy)
    {
        $this->delivery = $delivery;
        $this->strategy = $strategy;
    }

    public function handle()
    {
        $recipientContact = $this->delivery->recipient_contact;
        $message = $this->delivery->invitation->message;
        $invitationLink = $this->delivery->url;

        $success = $this->strategy->send($recipientContact, $message, $invitationLink);

        $this->delivery->status = $success ? InvitationDeliveryStatus::SENT->value : InvitationDeliveryStatus::FAILED->value;
        $this->delivery->save();
    }
}
