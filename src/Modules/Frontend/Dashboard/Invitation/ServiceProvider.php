<?php

namespace Modules\Frontend\Dashboard\Invitation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Invitation\Repositories\EloquentInvitationQueryRepository;
use Modules\Frontend\Dashboard\Invitation\Repositories\EloquentInvitationCommandRepository;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;
use Modules\Frontend\Dashboard\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->app->register(InvitationDelivery\ServiceProvider::class);
    }

    public function register(): void
    {
        $this->app->bind(InvitationCommandRepositoryInterface::class, EloquentInvitationCommandRepository::class);
        $this->app->bind(InvitationQueryRepositoryInterface::class, EloquentInvitationQueryRepository::class);
    }
}
