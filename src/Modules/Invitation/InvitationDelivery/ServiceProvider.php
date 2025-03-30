<?php

namespace Modules\Invitation\InvitationDelivery;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliverySendService;
use Modules\Invitation\InvitationDelivery\Strategies\EmailInvitationChannelStrategy;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->singleton(InvitationDeliverySendService::class, function () {
            $channels = [
                'email' => new EmailInvitationChannelStrategy(),
            ];

            return new InvitationDeliverySendService($channels);
        });
    }
}
