<?php

namespace Modules\AuthTrustedDevice;

use Infrastructure\Events\RegisterListeners;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\AuthTrustedDevice\Events\Listeners\AuthTrustedDeviceCreateListener;

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
