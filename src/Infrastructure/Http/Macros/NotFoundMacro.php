<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;

final class NotFoundMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('notFound', function (?string $message = null): JsonResponse {
            return response()->error(
                'not_found',
                message: $message,
                code: JsonResponse::HTTP_NOT_FOUND,
            );
        });
    }
}
