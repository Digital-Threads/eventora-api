<?php

namespace Infrastructure\Auth\Operators\Logical;

use Infrastructure\Auth\Check;
use Infrastructure\Auth\CheckFailure;
use Infrastructure\Auth\CheckResponse;

final class NotCheck extends Check
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

            if ($response->allow) {
                return new CheckResponse(
                    false,
                    new CheckFailure(
                        $this->negated($response->failure->error),
                        $this->negated($response->failure->errorDescription),
                        $this->negated($response->failure->message),
                        $this->negated($response->failure->hint),
                    ),
                );
            }
        }

        return CheckResponse::allowed();
    }

    private function negated(?string $message): ?string
    {
        if (!$message) {
            return null;
        }

        if (str_ends_with($message, '!')) {
            return str($message)->beforeLast('!')->toString();
        }

        return "{$message}!";
    }
}
