<?php

namespace Modules\Event\Http\Resources;

use Modules\Event\Http\Schemas\ClientEventSchema;
use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Event;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property Event $resource
 */
final class ClientEventResource extends JsonResource
{
    use ConvertsSchemaToArray;


    public function toSchema(Request $request): ClientEventSchema
    {
        return new ClientEventSchema(
            $this->resource->id,
            $this->resource->title,
            $this->resource->event_date,
            $this->resource->location,
            $this->resource->image_url,
            $this->resource->tags
        );
    }
}
