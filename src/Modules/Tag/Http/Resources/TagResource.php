<?php

namespace Modules\Tag\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Tag;
use Modules\Tag\Http\Schemas\TagSchema;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;

/**
 * @property Tag $resource
 */
final class TagResource extends JsonResource
{
    use ConvertsSchemaToArray;

    /**
     * @param  Request  $request
     *
     * @return TagSchema
     */
    public function toSchema(Request $request): TagSchema
    {
        return new TagSchema(
            $this->resource->id,
            $this->resource->name,
        );
    }
}