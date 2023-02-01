<?php

namespace Modules\AuthFacebook;

use Infrastructure\Auth\DefineGates;
use Modules\AuthFacebook\Policies\AuthFacebookPolicy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:facebook' => AuthFacebookPolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
