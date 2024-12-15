<?php

namespace Modules\EventCategory\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="EventCategorySchema", type="object")
 */
final class EventCategorySchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,
        /** @OA\Property() */
        public string $name,
        /** @OA\Property() */
        public string $slug,
    ) {}
}
