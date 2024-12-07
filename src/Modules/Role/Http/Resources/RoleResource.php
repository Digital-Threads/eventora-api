<?php

namespace Modules\Role\Http\Resources;

use Modules\Role\Http\Schemas\RoleSchema;
use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\Role;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

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
