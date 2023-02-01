<?php

namespace Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static fn ($name) => 'Database\\Factories\\' . class_basename($name) . 'Factory');
        Factory::guessModelNamesUsing(static fn ($name) => 'Infrastructure\\Eloquent\\Models\\' . str($name::class)->classBasename()->beforeLast('Factory'));
    }
}
