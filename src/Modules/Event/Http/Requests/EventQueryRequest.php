<?php

namespace Modules\Event\Http\Requests;

use Modules\Event\Dto\EventQueryRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class EventQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'categoryId' => ['nullable', 'integer', 'exists:event_categories,id'],
            'isPublic' => ['nullable', 'boolean'],
            'perPage' => ['nullable', 'int', 'min:1', 'max:50'],
            'cursor' => ['nullable', 'string'],
        ];
    }

    public function toDto(): EventQueryRequestDto
    {
        return new EventQueryRequestDto(
            $this->query('categoryId'),
            $this->query('isPublic'),
            (int) $this->query('perPage', '30'),
            $this->query('cursor')
        );
    }
}