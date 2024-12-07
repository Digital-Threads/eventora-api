<?php

namespace Modules\Auth\AuthTrustedDevice\Http\Resources;

use Modules\Auth\AuthTrustedDevice\Http\Schemas\AuthTrustedDeviceSchema;
use Illuminate\Http\Request;
use Infrastructure\Eloquent\Models\UserTrustedDevice;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property UserTrustedDevice $resource
 */
final class AuthTrustedDeviceResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): AuthTrustedDeviceSchema
    {
        return new AuthTrustedDeviceSchema(
            $this->resource->id,
            $this->resource->ip,
            $this->resource->user_agent,
            $this->resource->valid_to->toRfc3339String(),
        );
    }
}
