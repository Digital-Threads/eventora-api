<?php

namespace Infrastructure\Macros;

abstract class AbstractMacro
{
    abstract protected function register(): void;

    final public static function bind(): void
    {
        app(static::class)->register();
    }
}
