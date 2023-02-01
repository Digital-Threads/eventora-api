<?php

namespace Infrastructure\Auth\Operators\Logical;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckResponse;

final class AndCheck extends Check
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
        foreach ($this->assertions as $assertion) {
            $response = $this->check($assertion);

            if (!$response->allow) {
                return $response;
            }
        }

        return CheckResponse::allowed();
    }
}
