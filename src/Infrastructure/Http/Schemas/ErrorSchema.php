<?php

namespace Infrastructure\Http\Schemas;

/**
 * @OA\Schema(
 *     schema="ErrorSchema",
 *     type="object"
 * )
 */
final class ErrorSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public string $error,
        /** @OA\Property() */
        public ?string $errorDescription,
        /** @OA\Property() */
        public ?string $message,
        /** @OA\Property() */
        public ?string $hint,
    ) {
        //
    }
}
