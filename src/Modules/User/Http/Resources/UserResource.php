<?php

namespace Modules\User\Http\Resources;

use Modules\User\Http\Schemas\UserSchema;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property User $resource
 */
final class UserResource extends JsonResource
{
    /**
     *
     */
    public function toSchema($request): UserSchema
    {
        return new UserSchema(
            $this->resource->id,
            $this->resource->first_name,
            $this->resource->last_name,
            $this->resource->email
        );
    }
}
