<?php

namespace Modules\AuthGoogle2FA\Http\Resources;

use Infrastructure\Http\Resources\JsonResource;
use Infrastructure\Http\Resources\ConvertsSchemaToArray;
use Modules\AuthGoogle2FA\Dto\AuthGoogle2FACredentialsDto;
use Modules\AuthGoogle2FA\Http\Schemas\AuthGoogle2FACredentialsSchema;

/**
 * @property AuthGoogle2FACredentialsDto $resource
 */
final class AuthGoogle2FACredentialsResource extends JsonResource
{
    use ConvertsSchemaToArray;

    public function toSchema($request): AuthGoogle2FACredentialsSchema
    {
        return new AuthGoogle2FACredentialsSchema(
            $this->resource->qr,
            $this->resource->secretKey,
            $this->resource->recoveryCode,
        );
    }
}
