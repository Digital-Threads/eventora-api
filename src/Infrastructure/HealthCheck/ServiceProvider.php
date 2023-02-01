<?php

namespace Infrastructure\HealthCheck;

use Infrastructure\HealthCheck\Checks\LogCheck;
use Illuminate\Contracts\Foundation\Application;
use Infrastructure\HealthCheck\Checks\CacheCheck;
use Infrastructure\HealthCheck\Checks\StorageCheck;
use Infrastructure\HealthCheck\Checks\DatabaseCheck;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Infrastructure\HealthCheck\Http\Actions\HealthCheckAction;

final class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app
            ->when(HealthCheckAction::class)
            ->needs('$healthChecks')
            ->give(static function (Application $app) {
                return [
                    $app->make(DatabaseCheck::class),
                    $app->make(CacheCheck::class),
                    $app->make(LogCheck::class),
                    $app->make(StorageCheck::class),
                ];
            });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
