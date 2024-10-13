<?php

namespace Modules\Company\Http\Schemas;

use Infrastructure\Http\Schemas\AbstractSchema;

/**
 * @OA\Schema(schema="CompanySchema", type="object")
 */
class CompanySchema extends AbstractSchema
{
    public function __construct(
        /** @OA\Property() */
        public int $id,

        /** @OA\Property() */
        public string $name,

        /** @OA\Property() */
        public string $slug,

        /** @OA\Property() */
        public ?string $description,

        /** @OA\Property() */
        public ?string $avatarUrl,

        /** @OA\Property() */
        public ?string $websiteUrl,

        /** @OA\Property() */
        public ?string $activityDescription
    ) {}
}
