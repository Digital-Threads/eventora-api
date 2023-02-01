<?php

namespace Infrastructure\HealthCheck\Checks;

use Throwable;
use Illuminate\Support\Facades\Log;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;

final class LogCheck extends AbstractCheck
{
    private const CONTENTS = 'health_check';

    public function check(): void
    {
        try {
            Log::info(self::CONTENTS);
        } catch (Throwable $e) {
            throw new CheckFailedException(
                $e->getMessage(),
                str($this::class)->classBasename()->snake(),
                $e,
            );
        }
    }
}
