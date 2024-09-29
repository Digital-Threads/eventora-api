<?php

namespace Modules\Event\Http\Requests;

use Modules\Event\Dto\EventViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;


final class EventViewRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:events,id'],
        ];
    }

    /**
     * @return EventViewRequestDto
     */
    public function toDto(): EventViewRequestDto
    {
        return new EventViewRequestDto($this->route('id'));
    }
}