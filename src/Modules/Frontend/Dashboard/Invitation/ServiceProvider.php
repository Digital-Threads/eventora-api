<?php

namespace Modules\Frontend\Dashboard\Invitation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Invitation\Repositories\EloquentInvitationCommandRepository;
use Modules\Frontend\Dashboard\Invitation\Repositories\EloquentInvitationQueryRepository;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {

        $this->app->register(\Modules\Frontend\Dashboard\Invitation\InvitationDelivery\ServiceProvider::class);
    }

    public function register(): void
    {
        $this->app->bind(InvitationCommandRepositoryInterface::class, EloquentInvitationCommandRepository::class);
        $this->app->bind(InvitationQueryRepositoryInterface::class, EloquentInvitationQueryRepository::class);
    }
}
