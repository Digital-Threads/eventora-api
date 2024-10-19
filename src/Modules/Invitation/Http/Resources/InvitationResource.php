<?php

namespace Modules\Invitation\Http\Resources;

use Infrastructure\Eloquent\Models\Invitation;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Invitation\Http\Schemas\InvitationSchema;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;

/**
 * @property Invitation $resource
 */
final class InvitationResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): InvitationSchema
    {
        return new InvitationSchema(
            $this->resource->id,
            $this->resource->event_id,
            $this->resource->title,
            $this->resource->message,
            $this->resource->invitation_link,
            $this->resource->created_at->toDateTimeString(),
            $this->resource->updated_at->toDateTimeString(),
        );
    }
}
