<?php

namespace Modules\EventMetric\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="EventMetricSchema", type="object")
 */
final class EventMetricSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $event_id,

        /** @OA\Property() */
        public int $views,

        /** @OA\Property() */
        public int $tickets_sold,

        /** @OA\Property() */
        public int $subscriptions,

        /** @OA\Property() */
        public int $comments,

        /** @OA\Property() */
        public int $likes,

        /** @OA\Property() */
        public float $rating,

        /** @OA\Property() */
        public int $participants,

        /** @OA\Property() */
        public int $shares
    ) {}
}
