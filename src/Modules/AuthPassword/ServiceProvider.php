<?php

namespace Modules\AuthPassword;

use Infrastructure\Auth\DefineGates;
use Modules\AuthPassword\Policies\AuthPasswordPolicy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:password' => AuthPasswordPolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
