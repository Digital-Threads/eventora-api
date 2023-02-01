<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;
use Infrastructure\Http\Schemas\ErrorBagSchema;

final class ErrorBagMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('errorBag', function (array $errors, ?int $code = null): JsonResponse {
            return response()->schema(new ErrorBagSchema($errors), $code ?? JsonResponse::HTTP_BAD_REQUEST);
        });
    }
}
