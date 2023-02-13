<?php

namespace Modules\Frontend\Company\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthProfileSchema", type="object")
 */
final class CompanySchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(minimum=1) */
        public int $id,
        /** @OA\Property() */
        public string $name,

    ) {
        //
    }
}
