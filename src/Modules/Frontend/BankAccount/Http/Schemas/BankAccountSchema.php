<?php

namespace Modules\Frontend\BankAccount\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthProfileSchema", type="object")
 */
final class BankAccountSchema extends AbstractSchema
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
