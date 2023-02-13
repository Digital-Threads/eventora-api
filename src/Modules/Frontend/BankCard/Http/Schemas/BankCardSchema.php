<?php

namespace Modules\Frontend\BankCard\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthProfileSchema", type="object")
 */
final class BankCardSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(minimum=1) */
        public int $id,
        /** @OA\Property() */
        public int $cardNumber,
        /** @OA\Property() */
        public string $cardEmployeeName,
        /** @OA\Property() */
        public int $expiredMonth,
        /** @OA\Property() */
        public int $expiredYear,
        /** @OA\Property() */
        public ?int $currencyId,
    ) {
        //
    }
}
