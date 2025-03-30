<?php

namespace Modules\Invitation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->app->register(\Modules\Invitation\InvitationDelivery\ServiceProvider::class);
    }

    public function register(): void
    {

    }
}
