<?php

namespace Modules\EventMetric\Http\Requests;

use Modules\EventMetric\Dto\EventMetricViewRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class EventMetricViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'eventId' => ['required', 'integer', 'exists:events,id'],
        ];
    }

    public function toDto(): EventMetricViewRequestDto
    {
        return new EventMetricViewRequestDto(
            $this->route('eventId')
        );
    }
}
