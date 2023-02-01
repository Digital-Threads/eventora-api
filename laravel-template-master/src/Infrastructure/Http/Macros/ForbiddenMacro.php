<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;

final class ForbiddenMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('forbidden', function (?string $message = null): JsonResponse {
            return response()->error(
                'forbidden',
                message: $message,
                code: JsonResponse::HTTP_FORBIDDEN,
            );
        });
    }
}
