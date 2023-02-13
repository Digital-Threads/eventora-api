<?php

namespace Modules\Frontend\Bank\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthProfileSchema", type="object")
 */
final class BankSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(minimum=1) */
        public int $id,
        /** @OA\Property() */
        public string $name,
        /** @OA\Property() */
        public ?string $country,
        /** @OA\Property() */
        public ?string $city,
        /** @OA\Property() */
        public ?string $address,
    ) {
        //
    }
}
