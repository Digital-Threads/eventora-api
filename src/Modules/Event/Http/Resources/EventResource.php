<?php

namespace Modules\Event\Http\Resources;

use Infrastructure\Eloquent\Models\Event;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Event\Http\Schemas\EventSchema;

/**
 * @property Event $resource
 */
final class EventResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     * @param $request
     *
     * @return EventSchema
     */
    public function toSchema($request): EventSchema
    {
        return new EventSchema(
            $this->resource->id,
            $this->resource->title,
            $this->resource->description,
            $this->resource->event_date,
            $this->resource->location,
            $this->resource->is_public,
            $this->resource->organizer_id,
            $this->resource->category_id,
            $this->resource->template_id,
            $this->resource->company_id,
            $this->resource->terms_conditions,
        );
    }
}
