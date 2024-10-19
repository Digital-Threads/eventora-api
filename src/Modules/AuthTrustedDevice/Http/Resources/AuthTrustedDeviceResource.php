<?php

namespace Modules\AuthTrustedDevice\Http\Resources;

use Illuminate\Http\Request;
use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Eloquent\Models\UserTrustedDevice;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Modules\AuthTrustedDevice\Http\Schemas\AuthTrustedDeviceSchema;

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
