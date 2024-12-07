<?php

namespace Modules\Auth\AuthGoogle2FA\Http\Resources;

use Modules\Auth\AuthGoogle2FA\Dto\AuthGoogle2FACredentialsDto;
use Modules\Auth\AuthGoogle2FA\Http\Schemas\AuthGoogle2FACredentialsSchema;
use Illuminate\Http\Request;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property AuthGoogle2FACredentialsDto $resource
 */
final class AuthGoogle2FACredentialsResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema(Request $request): AuthGoogle2FACredentialsSchema
    {
        return new AuthGoogle2FACredentialsSchema(
            $this->resource->qr,
            $this->resource->secretKey,
            $this->resource->recoveryCode,
        );
    }
}
