<?php

namespace Modules\Tag\Http\Resources;

use Modules\Tag\Http\Schemas\TagSchema;
use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Tag;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

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
