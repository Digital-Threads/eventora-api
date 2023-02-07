<?php

namespace Modules\Frontend\CompanyType;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
