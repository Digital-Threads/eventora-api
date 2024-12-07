<?php

namespace Modules\Invitation\InvitationDelivery\Services;

use Modules\Invitation\InvitationDelivery\Jobs\InvitationDeliverySendJob;
use Infrastructure\Eloquent\Models\InvitationDelivery;

class InvitationDeliverySendService
{
    public function __construct(protected array $channels)
    {
    }

    public function sendInvitations(array $deliveries): void
    {
        /** @var InvitationDelivery $delivery */
        foreach ($deliveries as $delivery) {
            if (array_key_exists($delivery->channel, $this->channels)) {
                $strategy = $this->channels[$delivery->channel];
                InvitationDeliverySendJob::dispatch($delivery, $strategy);
            }
        }
    }
}
