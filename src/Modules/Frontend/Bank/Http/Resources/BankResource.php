<?php

namespace Modules\Frontend\Bank\Http\Resources;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\Bank\Http\Schemas\BankSchema;

/**
 * @property User $resource
 */
final class BankResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): BankSchema
    {
        return new BankSchema(
            $this->resource->id,
            $this->resource->name,
            $this->resource->country,
            $this->resource->city,
            $this->resource->address
        );
    }
}
