<?php

namespace Modules\Frontend\Dashboard\Invitation;

use Domain\Invitation\Repositories\InvitationCommandRepositoryInterface;
use Domain\Invitation\Repositories\InvitationQueryRepositoryInterface;
use Infrastructure\Eloquent\Repositories\Invitation\EloquentInvitationCommandRepository;
use Infrastructure\Eloquent\Repositories\Invitation\EloquentInvitationQueryRepository;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->app->register(InvitationDelivery\ServiceProvider::class);
    }

    public function register(): void
    {

    }
}
