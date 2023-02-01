<?php

namespace Infrastructure\HealthCheck\Checks;

use Throwable;
use Illuminate\Support\Facades\DB;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;

final class DatabaseCheck extends AbstractCheck
{
    public function check(): void
    {
        try {
            DB::connection()->getPdo();
        } catch (Throwable $e) {
            throw new CheckFailedException(
                $e->getMessage(),
                str($this::class)->classBasename()->snake(),
                $e,
            );
        }
    }
}
