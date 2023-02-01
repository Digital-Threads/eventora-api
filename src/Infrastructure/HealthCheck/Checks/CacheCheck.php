<?php

namespace Infrastructure\HealthCheck\Checks;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Cache;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;

final class CacheCheck extends AbstractCheck
{
    private const CACHE_KEY_PREFIX = 'health_check_';
    private const HEALTHY_STATUS = '1';

    public function check(): void
    {
        try {
            $key = uniqid(self::CACHE_KEY_PREFIX, true);

            Cache::put($key, self::HEALTHY_STATUS, 60);

            if (Cache::pull($key) !== self::HEALTHY_STATUS) {
                throw new Exception('Cache pull error!');
            }
        } catch (Throwable $e) {
            throw new CheckFailedException(
                $e->getMessage(),
                str($this::class)->classBasename()->snake(),
                $e,
            );
        }
    }
}
