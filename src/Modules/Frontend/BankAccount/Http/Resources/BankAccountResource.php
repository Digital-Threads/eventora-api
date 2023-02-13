<?php

namespace Modules\Frontend\BankAccount\Http\Resources;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\BankAccount\Http\Schemas\BankAccountSchema;

/**
 * @property User $resource
 */
final class BankAccountResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): BankAccountSchema
    {
        return new BankAccountSchema(
            $this->resource->id,
            $this->resource->name,
            $this->resource->country,
            $this->resource->city,
            $this->resource->address
        );
    }
}
