<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;

final class MessageMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('message', function (string $message, ?int $code = null): JsonResponse {
            return response()->json([
                'message' => $message,
            ], $code ?? JsonResponse::HTTP_OK);
        });
    }
}
