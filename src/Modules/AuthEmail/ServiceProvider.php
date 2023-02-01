<?php

namespace Modules\AuthEmail;

use Infrastructure\Auth\DefineGates;
use Modules\AuthEmail\Policies\AuthEmailPolicy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:email' => AuthEmailPolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
