<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Company\Dto\CompanyCreateRequestDto;

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
