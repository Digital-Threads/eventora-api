<?php

namespace Modules\User\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="UserSchema", type="object")
 */
final class UserSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public string $firstName,

        /** @OA\Property() */
        public string $lastName,

        /** @OA\Property() */
        public string $email
    ) {
        //
    }
}