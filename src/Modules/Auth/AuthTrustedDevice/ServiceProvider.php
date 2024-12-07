<?php

namespace Modules\Auth\AuthTrustedDevice;

use Modules\Auth\AuthTrustedDevice\Events\Listeners\AuthTrustedDeviceCreateListener;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Infrastructure\Events\RegisterListeners;

final class ServiceProvider extends BaseServiceProvider
{
    use RegisterListeners;

    protected array $listeners = [
        'auth_trusted_device.create' => AuthTrustedDeviceCreateListener::class,
    ];

    public function boot(): void
    {
        $this->registerListeners();
    }
}
