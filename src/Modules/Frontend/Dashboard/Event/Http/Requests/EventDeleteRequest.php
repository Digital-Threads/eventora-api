<?php

namespace Modules\Frontend\Dashboard\Event\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Event\Dto\EventDeleteRequestDto;

final class EventDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:events,id',
        ];
    }

    public function toDto(): EventDeleteRequestDto
    {
        return new EventDeleteRequestDto($this->route('id'));
    }
}
