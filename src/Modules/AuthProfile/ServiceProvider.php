<?php

namespace Modules\AuthProfile;

use Infrastructure\Auth\DefineGates;
use Modules\AuthProfile\Policies\AuthProfilePolicy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:profile' => AuthProfilePolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
