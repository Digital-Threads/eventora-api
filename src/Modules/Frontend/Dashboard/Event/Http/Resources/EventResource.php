<?php

namespace Modules\Frontend\Dashboard\Event\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Event;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\Dashboard\Event\Http\Schemas\EventSchema;

/**
 * @property Event $resource
 */
final class EventResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     *
     */
    public function toSchema(Request $request): EventSchema
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
            $this->resource->image_url,
            $this->resource->max_participants,
            $this->resource->age_limit,
            $this->resource->event_type,
            $this->resource->streaming_link,
            $this->resource->tags,
            $this->resource->registration_deadline,
            $this->resource->qr_code
        );
    }
}
