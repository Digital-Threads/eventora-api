<?php

namespace Infrastructure\Http\Macros;

use Illuminate\Http\JsonResponse;
use Infrastructure\Macros\AbstractMacro;
use Infrastructure\Http\Schemas\AbstractSchema;

final class SchemaMacro extends AbstractMacro
{
    protected function register(): void
    {
        response()->macro('schema', function (AbstractSchema $schema, ?int $code = null): JsonResponse {
            return response()->json($schema->toArray(), $code ?? JsonResponse::HTTP_OK);
        });
    }
}
