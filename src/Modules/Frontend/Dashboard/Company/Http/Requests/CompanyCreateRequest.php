<?php

namespace Modules\Frontend\Dashboard\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Company\Dto\CompanyCreateRequestDto;

/**
 * @OA\Schema(
 *     schema="CompanyCreateRequest",
 *     type="object",
 *     required={"name", "slug"},
 *     @OA\Property(property="name", type="string", example="Company A", description="The name of the company"),
 *     @OA\Property(property="slug", type="string", example="company-a", description="Unique identifier for the company"),
 *     @OA\Property(property="description", type="string", nullable=true, example="A great company", description="Description of the company"),
 *     @OA\Property(property="avatar_url", type="string", nullable=true, example="https://example.com/avatar.png", description="URL to the company avatar"),
 *     @OA\Property(property="website_url", type="string", nullable=true, example="https://example.com", description="Website URL of the company"),
 *     @OA\Property(property="activity_description", type="string", nullable=true, example="Technology and software development", description="Description of the company's activity"),
 * )
 */
class CompanyCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:companies,slug',
            'description' => 'nullable|string',
            'avatar_url' => 'nullable|string',
            'website_url' => 'nullable|string',
            'activity_description' => 'nullable|string',
        ];
    }

    public function toDto(): CompanyCreateRequestDto
    {
        return new CompanyCreateRequestDto(
            $this->input('name'),
            $this->input('slug'),
            $this->input('description'),
            $this->input('avatar_url'),
            $this->input('website_url'),
            $this->input('activity_description')
        );
    }
}
