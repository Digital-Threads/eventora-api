<?php

namespace Modules\Frontend\Dashboard\Event;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Event\Repositories\EloquentEventQueryRepository;
use Modules\Frontend\Dashboard\Event\Repositories\EloquentEventCommandRepository;
use Modules\Frontend\Dashboard\Event\Repositories\Interfaces\EventQueryRepositoryInterface;
use Modules\Frontend\Dashboard\Event\Repositories\Interfaces\EventCommandRepositoryInterface;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->bind(EventQueryRepositoryInterface::class, EloquentEventQueryRepository::class);
        $this->app->bind(EventCommandRepositoryInterface::class, EloquentEventCommandRepository::class);
    }
}
