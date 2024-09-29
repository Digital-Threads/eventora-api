<?php

namespace Modules\Event;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Event\Repositories\EloquentEventCommandRepository;
use Modules\Event\Repositories\EloquentEventQueryRepository;
use Modules\Event\Repositories\Interfaces\EventCommandRepositoryInterface;
use Modules\Event\Repositories\Interfaces\EventQueryRepositoryInterface;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    public function register()
    {
        $this->app->bind(EventQueryRepositoryInterface::class, EloquentEventQueryRepository::class);
        $this->app->bind(EventCommandRepositoryInterface::class, EloquentEventCommandRepository::class);
    }
}