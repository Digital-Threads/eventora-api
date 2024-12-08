<?php

namespace Modules\EventMetric\Http\Requests;

use Modules\EventMetric\Dto\EventMetricPopularRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class EventMetricPopularRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'perPage' => ['nullable', 'integer', 'min:1', 'max:50'],
            'cursor' => ['nullable', 'string'],
        ];
    }

    public function toDto(): EventMetricPopularRequestDto
    {
        return new EventMetricPopularRequestDto(
            (int) $this->query('perPage', 10),
            $this->query('cursor')
        );
    }
}
