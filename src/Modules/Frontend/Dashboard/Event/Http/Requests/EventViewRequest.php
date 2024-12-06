<?php

namespace Modules\Frontend\Dashboard\Event\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Event\Dto\EventViewRequestDto;

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
     */
    public function toDto(): EventViewRequestDto
    {
        return new EventViewRequestDto($this->route('id'));
    }
}
