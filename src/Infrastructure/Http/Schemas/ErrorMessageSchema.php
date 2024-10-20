<?php

namespace Infrastructure\Http\Schemas;

/**
 * @OA\Schema(
 *     schema="ErrorMessageSchema",
 *     type="object"
 * )
 */
final class ErrorMessageSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(
         *     description="Error message",
         *     example="An error occurred"
         * )
         */
        public string $message
    ) {
        //
    }
}
