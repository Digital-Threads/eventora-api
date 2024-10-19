<?php

namespace Modules\Tag;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Tag\Repositories\EloquentTagCommandRepository;
use Modules\Tag\Repositories\EloquentTagQueryRepository;
use Modules\Tag\Repositories\Interfaces\TagCommandRepositoryInterface;
use Modules\Tag\Repositories\Interfaces\TagQueryRepositoryInterface;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind(TagCommandRepositoryInterface::class, EloquentTagCommandRepository::class);
        $this->app->bind(TagQueryRepositoryInterface::class, EloquentTagQueryRepository::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
