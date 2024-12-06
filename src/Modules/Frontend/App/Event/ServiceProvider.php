<?php

namespace Modules\Frontend\App\Event;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Event\Repositories\EloquentEventCommandRepository;
use Modules\Frontend\Dashboard\Event\Repositories\EloquentEventQueryRepository;
use Modules\Frontend\Dashboard\Event\Repositories\Interfaces\EventCommandRepositoryInterface;
use Modules\Frontend\Dashboard\Event\Repositories\Interfaces\EventQueryRepositoryInterface;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {

    }

    public function register()
    {
    }
}
