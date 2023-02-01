<?php

namespace Modules\AuthGoogle;

use Infrastructure\Auth\DefineGates;
use Modules\AuthGoogle\Policies\AuthGooglePolicy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:google' => AuthGooglePolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
