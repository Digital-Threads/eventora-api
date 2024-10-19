<?php

namespace Modules\Event\Http\Requests;

use Modules\Event\Dto\EventDeleteRequestDto;
use Illuminate\Foundation\Http\FormRequest;

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
