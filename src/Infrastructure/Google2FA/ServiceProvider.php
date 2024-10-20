<?php

namespace Infrastructure\Google2FA;

use PragmaRX\Google2FAQRCode\Google2FA;
use Infrastructure\Google2FA\Impl as Impl;
use PragmaRX\Google2FAQRCode\QRCode\Bacon;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use Illuminate\Contracts\Support\DeferrableProvider;
use PragmaRX\Google2FAQRCode\QRCode\QRCodeServiceContract;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(QRCodeServiceContract::class, static fn () => new Bacon(new ImagickImageBackEnd()));

        $this->app->bind(Google2FAService::class, static fn () => new Impl\Google2FAService(
            new Google2FA(
                app(QRCodeServiceContract::class),
            ),
            new Impl\Google2FAConfig(
                config('services.google2fa.company'),
            ),
        ));
    }

    public function provides(): array
    {
        return [
            Google2FAService::class,
        ];
    }
}
