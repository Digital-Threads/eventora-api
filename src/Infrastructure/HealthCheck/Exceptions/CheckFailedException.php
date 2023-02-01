<?php

namespace Infrastructure\HealthCheck\Exceptions;

use Throwable;
use RuntimeException;
use Illuminate\Http\JsonResponse;

final class CheckFailedException extends RuntimeException
{
    public function __construct(
        string $message,
        private readonly string $check,
        Throwable $previous,
    ) {
        parent::__construct($message, previous: $previous);
    }

    public function render(): JsonResponse
    {
        return response()->error(
            $this->check,
            message: $this->message,
            code: JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        );
    }
}
