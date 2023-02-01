<?php

namespace Modules\AuthGoogle2FA\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthGoogle2FACredentialsSchema", type="object")
 */
final class AuthGoogle2FACredentialsSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public string $qr,
        /** @OA\Property() */
        public string $secretKey,
        /** @OA\Property() */
        public string $recoveryCode,
    ) {
        //
    }
}
