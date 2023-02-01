<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;
use Infrastructure\Http\Schemas\ErrorListSchema;

final class ErrorListMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('errorList', function (array $errors, ?int $code = null): JsonResponse {
            return response()->schema(new ErrorListSchema($errors), $code ?? JsonResponse::HTTP_BAD_REQUEST);
        });
    }
}
