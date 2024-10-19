<?php

namespace Modules\Company;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Company\Repositories\EloquentCompanyCommandRepository;
use Modules\Company\Repositories\EloquentCompanyQueryRepository;
use Modules\Company\Repositories\Interfaces\CompanyCommandRepositoryInterface;
use Modules\Company\Repositories\Interfaces\CompanyQueryRepositoryInterface;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    public function register(): void
    {
        $this->app->bind(CompanyCommandRepositoryInterface::class, EloquentCompanyCommandRepository::class);
        $this->app->bind(CompanyQueryRepositoryInterface::class, EloquentCompanyQueryRepository::class);
    }
}
