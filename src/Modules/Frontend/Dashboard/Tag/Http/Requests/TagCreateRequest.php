<?php

namespace Modules\Frontend\Dashboard\Tag\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Tag\Dto\TagCreateRequestDto;

final class TagCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function toDto(): TagCreateRequestDto
    {
        return new TagCreateRequestDto(
            $this->input('name')
        );
    }
}
