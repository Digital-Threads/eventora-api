<?php

namespace Modules\Frontend\Company\Http\Resources;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\Company\Http\Schemas\CompanySchema;

/**
 * @property User $resource
 */
final class CompanyResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): CompanySchema
    {
        return new CompanySchema(
            $this->resource->id,
            $this->resource->name,
        );
    }
}
