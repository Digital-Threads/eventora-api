<?php

namespace Modules\Frontend\Dashboard\Company;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Company\Repositories\EloquentCompanyCommandRepository;
use Modules\Frontend\Dashboard\Company\Repositories\EloquentCompanyQueryRepository;
use Modules\Frontend\Dashboard\Company\Repositories\Interfaces\CompanyCommandRepositoryInterface;
use Modules\Frontend\Dashboard\Company\Repositories\Interfaces\CompanyQueryRepositoryInterface;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {

    }

    public function register(): void
    {
        $this->app->bind(CompanyCommandRepositoryInterface::class, EloquentCompanyCommandRepository::class);
        $this->app->bind(CompanyQueryRepositoryInterface::class, EloquentCompanyQueryRepository::class);
    }
}
