<?php

namespace App\Modules\EventCategory\Http\Resources;

use Modules\EventCategory\Http\Schemas\EventCategorySchema;
use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\EventMetric;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property EventMetric $resource
 */
final class EventCategoryResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): EventCategorySchema
    {
        return new EventCategorySchema(
            $this->resource->id,
            $this->resource->name,
            $this->resource->slug
        );
    }
}
