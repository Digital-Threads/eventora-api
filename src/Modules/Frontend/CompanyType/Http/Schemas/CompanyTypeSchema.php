<?php

namespace Modules\Frontend\CompanyType\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthProfileSchema", type="object")
 */
final class CompanyTypeSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(minimum=1) */
        public int $id,
        /** @OA\Property() */
        public ?string $name,
        /** @OA\Property() */
        public ?string $slug,

    ) {
        //
    }
}
