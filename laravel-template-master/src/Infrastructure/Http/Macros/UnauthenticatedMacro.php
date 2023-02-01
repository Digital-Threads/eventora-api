<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;

final class UnauthenticatedMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('unauthenticated', function (?string $message = null): JsonResponse {
            return response()->error(
                'unauthenticated',
                message: $message,
                code: JsonResponse::HTTP_UNAUTHORIZED,
            );
        });
    }
}
