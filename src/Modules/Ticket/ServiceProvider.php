<?php

namespace Modules\Ticket;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        // Bind your services or repositories here
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
