<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Company\Dto\CompanyUpdateRequestDto;

/**
 * @OA\Schema(
 *     schema="CompanyUpdateRequest",
 *     type="object",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         nullable=true,
 *         maxLength=255,
 *         example="New Company Name"
 *     ),
 *     @OA\Property(
 *         property="slug",
 *         type="string",
 *         nullable=true,
 *         example="new-company-slug"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         nullable=true,
 *         example="This is a sample company description"
 *     ),
 *     @OA\Property(
 *         property="avatar_url",
 *         type="string",
 *         nullable=true,
 *         example="https://example.com/avatar.jpg"
 *     ),
 *     @OA\Property(
 *         property="website_url",
 *         type="string",
 *         nullable=true,
 *         example="https://example.com"
 *     ),
 *     @OA\Property(
 *         property="activity_description",
 *         type="string",
 *         nullable=true,
 *         example="Company is engaged in tech development."
 *     )
 * )
 */
class CompanyUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'slug' => 'nullable|string|unique:companies,slug,' . $this->route('id'),
            'description' => 'nullable|string',
            'avatar_url' => 'nullable|string',
            'website_url' => 'nullable|string',
            'activity_description' => 'nullable|string',
        ];
    }

    public function toDto(): CompanyUpdateRequestDto
    {
        return new CompanyUpdateRequestDto(
            id: $this->route('id'),
            name: $this->input('name'),
            slug: $this->input('slug'),
            description: $this->input('description'),
            avatarUrl: $this->input('avatar_url'),
            websiteUrl: $this->input('website_url'),
            activityDescription: $this->input('activity_description')
        );
    }
}
