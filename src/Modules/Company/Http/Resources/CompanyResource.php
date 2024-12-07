<?php

namespace Modules\Company\Http\Resources;

use Modules\Company\Http\Schemas\CompanySchema;
use Infrastructure\Eloquent\Models\Company;
use Infrastructure\Http\Resources\JsonResource;

/**
 * @property Company $resource
 */
class CompanyResource extends JsonResource
{
    public function toSchema($request): CompanySchema
    {
        return new CompanySchema(
            id: $this->resource->id,
            name: $this->resource->name,
            slug: $this->resource->slug,
            description: $this->resource->description,
            avatarUrl: $this->resource->avatar_url,
            websiteUrl: $this->resource->website_url,
            activityDescription: $this->resource->activity_description,
        );
    }
}
