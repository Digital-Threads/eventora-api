<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;
use Infrastructure\Http\Schemas\IdSchema;

final class IdMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('id', function (int $id, ?int $code = null): JsonResponse {
            return response()->schema(new IdSchema($id), $code ?? JsonResponse::HTTP_OK);
        });
    }
}
