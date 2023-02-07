<?php

namespace Modules\Frontend\CompanyType\Http\Resources;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\CompanyType\Http\Schemas\CompanyTypeSchema;

/**
 * @property User $resource
 */
final class CompanyTypeResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): CompanyTypeSchema
    {
        return new CompanyTypeSchema(
            $this->resource->id,
            $this->resource->name,
            $this->resource->slug,
        );
    }
}
