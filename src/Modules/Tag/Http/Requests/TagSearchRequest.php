<?php

namespace Modules\Tag\Http\Requests;

use Modules\Tag\Dto\TagSearchRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class TagSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'query' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function toDto(): TagSearchRequestDto
    {
        return new TagSearchRequestDto(
            $this->input('query')
        );
    }
}
