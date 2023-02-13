<?php

namespace Modules\Frontend\BankCard\Http\Resources;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Frontend\BankCard\Http\Schemas\BankCardSchema;

/**
 * @property User $resource
 */
final class BankCardResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): BankCardSchema
    {
        return new BankCardSchema(
            $this->resource->id,
            $this->resource->card_number,
            $this->resource->card_employee_name,
            $this->resource->expired_month,
            $this->resource->expired_year,
            $this->resource->currency_id,
        );
    }
}
