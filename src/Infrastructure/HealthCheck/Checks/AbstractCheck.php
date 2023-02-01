<?php

namespace Infrastructure\HealthCheck\Checks;

use Infrastructure\HealthCheck\Exceptions\CheckFailedException;

abstract class AbstractCheck
{
    /**
     * @throws CheckFailedException
     * @return void
     */
    abstract public function check(): void;
}
