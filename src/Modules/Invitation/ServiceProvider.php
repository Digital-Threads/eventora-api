<?php

namespace Modules\Invitation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Invitation\Repositories\Interfaces\InvitationCommandRepositoryInterface;
use Modules\Invitation\Repositories\Interfaces\InvitationQueryRepositoryInterface;
use Modules\Invitation\Repositories\InvitationCommandRepository;
use Modules\Invitation\Repositories\InvitationQueryRepository;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    public function register(): void
    {
        $this->app->bind(InvitationCommandRepositoryInterface::class, InvitationCommandRepository::class);
        $this->app->bind(InvitationQueryRepositoryInterface::class, InvitationQueryRepository::class);

    }
}