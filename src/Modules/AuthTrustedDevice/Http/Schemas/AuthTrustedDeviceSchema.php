<?php

namespace Modules\AuthTrustedDevice\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="AuthTrustedDeviceSchema", type="object")
 */
final class AuthTrustedDeviceSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(minimum=1) */
        public int $id,
        /** @OA\Property() */
        public string $ip,
        /** @OA\Property() */
        public ?string $userAgent,
        /** @OA\Property(format="date-time") */
        public string $validTo,
    ) {
        //
    }
}
