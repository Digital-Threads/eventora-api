<?php

namespace Modules\Frontend\Dashboard\Tag;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Tag\Repositories\EloquentTagCommandRepository;
use Modules\Frontend\Dashboard\Tag\Repositories\EloquentTagQueryRepository;
use Modules\Frontend\Dashboard\Tag\Repositories\Interfaces\TagCommandRepositoryInterface;
use Modules\Frontend\Dashboard\Tag\Repositories\Interfaces\TagQueryRepositoryInterface;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind(TagCommandRepositoryInterface::class, EloquentTagCommandRepository::class);
        $this->app->bind(TagQueryRepositoryInterface::class, EloquentTagQueryRepository::class);
    }

    public function boot()
    {

    }
}
