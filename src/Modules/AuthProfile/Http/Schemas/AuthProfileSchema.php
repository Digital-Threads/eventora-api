<?php

namespace Modules\AuthProfile\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;
use Modules\Frontend\Company\Http\Schemas\CompanySchema;

/**
 * @OA\Schema(schema="AuthProfileSchema", type="object")
 */
final class AuthProfileSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(minimum=1) */
        public int $id,
        /** @OA\Property() */
        public ?string $firstName,
        /** @OA\Property() */
        public ?string $lastName,
        /** @OA\Property(format="email") */
        public ?string $email,
        /** @OA\Property() */
        public bool $hasPassword,
        /** @OA\Property() */
        public bool $hasGoogle,
        /** @OA\Property() */
        public bool $hasGoogle2FA,
        /** @OA\Property() */
        public bool $hasGoogle2FAEnabled,
        /** @OA\Property() */
        public bool $hasFacebook,
        /** @OA\Property(format="date-time") */
        public ?string $emailVerifiedAt,
        /** @OA\Property(format="date-time") */
        public ?string $passwordChangedAt,
        /** @OA\Property(format="date-time") */
        public string $registeredAt,
    ) {
        //
    }
}
