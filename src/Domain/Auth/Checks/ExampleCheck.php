<?php

namespace Domain\Auth\Checks;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;

final class ExampleCheck extends Check
{
    public function __construct(private int $number)
    {
        //
    }

    public function execute(): CheckResponse
    {
        return new CheckResponse(
            $this->number === 0,
            CheckFailure::create($this),
        );
    }
}
