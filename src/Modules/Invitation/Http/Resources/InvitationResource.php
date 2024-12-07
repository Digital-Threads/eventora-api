<?php

namespace Modules\Invitation\Http\Resources;

use Modules\Invitation\Http\Schemas\InvitationSchema;
use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Invitation;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property Invitation $resource
 */
final class InvitationResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): InvitationSchema
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
