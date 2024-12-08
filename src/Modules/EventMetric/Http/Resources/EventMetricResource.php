<?php

namespace Modules\EventMetric\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\EventMetric;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\EventMetric\Http\Schemas\EventMetricSchema;

/**
 * @property EventMetric $resource
 */
final class EventMetricResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): EventMetricSchema
    {
        return new EventMetricSchema(
            $this->resource->event_id,
            $this->resource->views,
            $this->resource->tickets_sold,
            $this->resource->subscriptions,
            $this->resource->comments,
            $this->resource->likes,
            $this->resource->rating,
            $this->resource->participants,
            $this->resource->shares
        );
    }
}
