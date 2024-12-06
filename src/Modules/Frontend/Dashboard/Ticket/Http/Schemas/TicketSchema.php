<?php

namespace Modules\Frontend\Dashboard\Ticket\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="TicketSchema", type="object")
 */
final class TicketSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public int $event_id,

        /** @OA\Property() */
        public string $type,

        /** @OA\Property() */
        public float $price,

        /** @OA\Property() */
        public int $quantity,

        /** @OA\Property() */
        public int $sold_quantity,

        /** @OA\Property() */
        public ?float $discount,

        /** @OA\Property() */
        public string $created_at,

        /** @OA\Property() */
        public string $updated_at
    ) {
    }
}
