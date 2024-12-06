<?php

namespace Modules\Frontend\Dashboard\Role\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Role;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Modules\Frontend\Dashboard\Role\Http\Schemas\RoleSchema;

/**
 * @property Role $resource
 */
final class RoleResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): RoleSchema
    {
        return new RoleSchema(
            $this->resource->id,
            $this->resource->name
        );
    }
}
