<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;
use Infrastructure\Http\Schemas\ErrorSchema;

final class ErrorMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('error', function (
            string $error,
            ?string $errorDescription = null,
            ?string $message = null,
            ?string $hint = null,
            ?int $code = null
        ): JsonResponse {
            return response()->schema(new ErrorSchema(
                $error,
                $errorDescription,
                $message,
                $hint,
            ), $code ?? JsonResponse::HTTP_BAD_REQUEST);
        });
    }
}
