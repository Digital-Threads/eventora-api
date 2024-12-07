<?php

namespace Modules\Tag\Http\Requests;

use Modules\Tag\Dto\TagCreateRequestDto;
use Illuminate\Foundation\Http\FormRequest;

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
