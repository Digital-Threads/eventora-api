<?php

namespace Infrastructure\Faker;

use Faker\Generator;
use Infrastructure\Faker\Providers\EnumProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    private array $providers = [
        EnumProvider::class,
    ];

    public function register(): void
    {
        $this->app->extend(Generator::class, function (Generator $generator): Generator {
            foreach ($this->providers as $provider) {
                $generator->addProvider(app($provider)->provide($generator));
            }

            return $generator;
        });
    }

    public function provides(): array
    {
        return [
            Generator::class,
        ];
    }
}
