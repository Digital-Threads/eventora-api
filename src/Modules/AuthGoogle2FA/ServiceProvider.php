<?php

namespace Modules\AuthGoogle2FA;

use Infrastructure\Auth\DefineGates;
use Modules\AuthGoogle2FA\Policies\AuthGoogle2FAPolicy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:google2fa' => AuthGoogle2FAPolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
