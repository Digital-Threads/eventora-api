<?php

namespace Infrastructure\Http\Schemas;

/**
 * @OA\Schema(
 *     schema="ErrorListSchema",
 *     type="object"
 * )
 */
final class ErrorListSchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property(type="array", @OA\Items(ref="#/components/schemas/ErrorSchema")) */
        public array $errors,
    ) {
        //
    }
}
