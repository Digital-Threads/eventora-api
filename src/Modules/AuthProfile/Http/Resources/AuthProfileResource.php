<?php

namespace Modules\AuthProfile\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Http\Resources\JsonResource;
use Modules\AuthProfile\Http\Schemas\AuthProfileSchema;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;

/**
 * @property User $resource
 */
final class AuthProfileResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): AuthProfileSchema
    {
        return new AuthProfileSchema(
            $this->resource->id,
            $this->resource->first_name,
            $this->resource->last_name,
            $this->resource->email,
            (bool) $this->resource->password,
            (bool) $this->resource->google_id,
            (bool) $this->resource->google_2fa_secret,
            $this->resource->google_2fa_enabled,
            (bool) $this->resource->facebook_id,
            $this->resource->email_verified_at?->toRfc3339String(),
            $this->resource->password_changed_at?->toRfc3339String(),
            $this->resource->registered_at->toRfc3339String(),
        );
    }
}
