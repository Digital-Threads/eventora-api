<?php

namespace Modules\Frontend\Dashboard\Event\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Event\Dto\EventQueryRequestDto;

final class EventQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'categoryId' => ['nullable', 'integer', 'exists:event_categories,id'],
            'isPublic' => ['nullable', 'boolean'],
            'perPage' => ['nullable', 'int', 'min:1', 'max:50'],
            'cursor' => ['nullable', 'string'],
            'companyId' => ['nullable', 'integer', 'exists:companies,id'],
        ];
    }

    public function toDto(): EventQueryRequestDto
    {
        return new EventQueryRequestDto(
            $this->query('categoryId'),
            $this->query('isPublic'),
            (int) $this->query('perPage', '30'),
            $this->query('cursor'),
            $this->query('companyId')
        );
    }
}
