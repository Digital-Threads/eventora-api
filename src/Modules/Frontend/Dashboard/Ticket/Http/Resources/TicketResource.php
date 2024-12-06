<?php

namespace Modules\Frontend\Dashboard\Ticket\Http\Resources;

use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\Dashboard\Ticket\Http\Schemas\TicketSchema;

/**
 * @OA\Schema(
 *     schema="TicketResource",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="event_id", type="integer"),
 *     @OA\Property(property="type", type="string"),
 *     @OA\Property(property="price", type="number", format="float"),
 *     @OA\Property(property="quantity", type="integer"),
 *     @OA\Property(property="sold_quantity", type="integer"),
 *     @OA\Property(property="discount", type="number", format="float"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
final class TicketResource extends JsonResource
{
    public function toSchema($request): TicketSchema
    {
        return new TicketSchema(
            $this->resource->id,
            $this->resource->event_id,
            $this->resource->type,
            $this->resource->price,
            $this->resource->quantity,
            $this->resource->sold_quantity,
            $this->resource->discount,
            $this->resource->created_at,
            $this->resource->updated_at
        );
    }
}