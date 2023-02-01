<?php

namespace Infrastructure\HealthCheck\Checks;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Storage;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;

final class StorageCheck extends AbstractCheck
{
    private const FILENAME_PREFIX = 'health_check_';

    public function check(): void
    {
        try {
            $filename = uniqid(self::FILENAME_PREFIX, true);

            Storage::put($filename, $filename);

            if (Storage::get($filename) !== $filename) {
                throw new Exception('Storage get error!');
            }

            Storage::delete($filename);
        } catch (Throwable $e) {
            throw new CheckFailedException(
                $e->getMessage(),
                str($this::class)->classBasename()->snake(),
                $e,
            );
        }
    }
}
