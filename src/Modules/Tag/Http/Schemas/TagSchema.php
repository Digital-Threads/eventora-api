<?php

namespace Modules\Tag\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="TagSchema", type="object")
 */
final class TagSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public string $name,
    ) {
    }
}
