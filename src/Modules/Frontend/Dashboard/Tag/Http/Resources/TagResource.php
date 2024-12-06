<?php

namespace Modules\Frontend\Dashboard\Tag\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Tag;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Modules\Frontend\Dashboard\Tag\Http\Schemas\TagSchema;

/**
 * @property Tag $resource
 */
final class TagResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     *
     */
    public function toSchema(Request $request): TagSchema
    {
        return new TagSchema(
            $this->resource->id,
            $this->resource->name,
        );
    }
}
