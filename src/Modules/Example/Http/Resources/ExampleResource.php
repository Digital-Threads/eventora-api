<?php

namespace Modules\Example\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\JsonResource;
use Modules\Example\Http\Schemas\ExampleSchema;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;

/**
 * @property User $resource
 */
final class ExampleResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): ExampleSchema
    {
        return new ExampleSchema(
            $this->resource->id,
        );
    }
}
