<?php

namespace Modules\Invitation\Http\Resources;

use Infrastructure\Eloquent\Models\Invitation;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Invitation\Http\Schemas\InvitationSchema;

/**
 * @property Invitation $resource
 */
final class InvitationResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     * @param $request
     *
     * @return InvitationSchema
     */
    public function toSchema($request): InvitationSchema
    {
        return new InvitationSchema(
            $this->resource->id,
            $this->resource->event_id,
            $this->resource->user_id,
            $this->resource->recipient_contact,
            $this->resource->channel,
            $this->resource->message,
            $this->resource->invitation_link,
            $this->resource->status,
            $this->resource->created_at->toDateTimeString(),
            $this->resource->updated_at->toDateTimeString(),
        );
    }
}