<?php

namespace Modules\AuthTrustedDevice;

use Infrastructure\Auth\DefineGates;
use Infrastructure\Events\RegisterListeners;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\AuthTrustedDevice\Policies\AuthTrustedDevicePolicy;
use Modules\AuthTrustedDevice\Events\Listeners\AuthTrustedDeviceCreateListener;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates, RegisterListeners;

    protected array $gates = [
        'auth:trustedDevice' => AuthTrustedDevicePolicy::class,
    ];

    protected array $listeners = [
        'auth_trusted_device.create' => AuthTrustedDeviceCreateListener::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->registerListeners();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
