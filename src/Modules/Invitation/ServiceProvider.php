<?php

namespace Modules\Invitation;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Invitation\Repositories\EloquentInvitationCommandRepository;
use Modules\Invitation\Repositories\EloquentInvitationQueryRepository;
use Modules\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;
use Modules\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    public function register(): void
    {
        $this->app->bind(InvitationCommandRepositoryInterface::class, EloquentInvitationCommandRepository::class);
        $this->app->bind(InvitationQueryRepositoryInterface::class, EloquentInvitationQueryRepository::class);
    }
}
