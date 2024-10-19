<?php

namespace Modules\Tag\Http\Resources;

use Infrastructure\Http\Resources\JsonResource;
use Modules\Tag\Http\Schemas\TagSchema;

/**
 * @property Tag $resource
 */
final class TagResource extends JsonResource
{
    public function toSchema($request): TagSchema
    {
        return new TagSchema(
            $this->id,
            $this->name // предполагается, что у вас есть поле name в таблице tags
        );
    }
}
