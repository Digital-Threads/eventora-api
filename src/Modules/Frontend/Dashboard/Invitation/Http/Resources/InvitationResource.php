<?php

namespace Modules\Frontend\Dashboard\Invitation\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Invitation;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Modules\Frontend\Dashboard\Invitation\Http\Schemas\InvitationSchema;

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
