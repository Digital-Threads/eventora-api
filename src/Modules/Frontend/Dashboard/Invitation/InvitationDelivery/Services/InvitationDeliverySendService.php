<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Services;

use Infrastructure\Eloquent\Models\InvitationDelivery;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Jobs\InvitationDeliverySendJob;

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
