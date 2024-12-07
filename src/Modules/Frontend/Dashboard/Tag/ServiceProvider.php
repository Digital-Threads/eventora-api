<?php

namespace Modules\Frontend\Dashboard\Tag;

use Domain\Tag\Repositories\TagCommandRepositoryInterface;
use Domain\Tag\Repositories\TagQueryRepositoryInterface;
use Infrastructure\Eloquent\Repositories\Tag\EloquentTagCommandRepository;
use Infrastructure\Eloquent\Repositories\Tag\EloquentTagQueryRepository;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
    }
}
