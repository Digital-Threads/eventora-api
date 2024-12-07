<?php

namespace Modules\Frontend\Dashboard\Company;

use Domain\Company\Repositories\CompanyCommandRepositoryInterface;
use Domain\Company\Repositories\CompanyQueryRepositoryInterface;
use Infrastructure\Eloquent\Repositories\Company\EloquentCompanyCommandRepository;
use Infrastructure\Eloquent\Repositories\Company\EloquentCompanyQueryRepository;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {

    }
}
