<?php

namespace Modules\Invitation\InvitationDelivery\Http\Resources;

use Infrastructure\Eloquent\Models\InvitationDelivery;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Invitation\InvitationDelivery\Http\Schemas\InvitationDeliverySchema;

/**
 * @property InvitationDelivery $resource
 */
final class InvitationDeliveryResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     * @param $request
     *
     * @return InvitationDeliverySchema
     */
    public function toSchema($request): InvitationDeliverySchema
    {
        return new InvitationDeliverySchema(
            $this->resource->id,
            $this->resource->invitation_id,
            $this->resource->recipient_contact,
            $this->resource->channel,
            $this->resource->status,
            $this->resource->retry_count,
            $this->resource->created_at->toDateTimeString(),
            $this->resource->updated_at->toDateTimeString(),
        );
    }
}
