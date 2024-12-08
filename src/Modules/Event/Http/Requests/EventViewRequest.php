<?php

namespace Modules\Event\Http\Requests;

use Modules\Event\Dto\EventViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class EventViewRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }


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
