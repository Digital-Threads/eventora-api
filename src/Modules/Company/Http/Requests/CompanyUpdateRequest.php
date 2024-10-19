<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Company\Dto\CompanyUpdateRequestDto;

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
