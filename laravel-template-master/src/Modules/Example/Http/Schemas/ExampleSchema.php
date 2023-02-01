<?php

namespace Modules\Example\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="ExampleSchema", type="object")
 */
final class ExampleSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,
    ) {
        //
    }
}
