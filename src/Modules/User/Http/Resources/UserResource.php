<?php

namespace Modules\User\Http\Resources;

use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\JsonResource;
use Modules\User\Http\Schemas\UserSchema;

/**
 * @property User $resource
 */
final class UserResource extends JsonResource
{
    /**
     * @param $request
     *
     * @return UserSchema
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