<?php

namespace Modules\Example\Http\Requests;

use Modules\Example\Dto\QueryRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class QueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'perPage' => [
                'nullable',
                'int',
                'min:1',
                'max:50',
            ],
            'cursor' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function toDto(): QueryRequestDto
    {
        return new QueryRequestDto(
            (int) $this->query('perPage', '30'),
            $this->query('cursor'),
        );
    }
}
