<?php

namespace Infrastructure\Auth\Operators\Logical;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckResponse;

final class OrCheck extends Check
{
    /**
     * @var Check[]
     */
    private readonly array $assertions;

    public function __construct(
        Check ...$assertions,
    ) {
        $this->assertions = $assertions;
    }

    public function execute(): CheckResponse
    {
        $result = CheckResponse::denied();

        foreach ($this->assertions as $assertion) {
            $response = $this->check($assertion);

            if ($response->allow) {
                return $response;
            }

            $result = $response;
        }

        return $result;
    }
}
