<?php

namespace Infrastructure\Macros;

use Illuminate\Contracts\Container\BindingResolutionException;

abstract class AbstractMacro
{
    abstract protected function register(): void;

    /**
     * @throws BindingResolutionException
     */
    final public static function bind(): void
    {
        app()->make(static::class)->register();
    }
}
