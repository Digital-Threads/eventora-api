<?php

namespace Modules\Event\Http\Requests;

use Modules\Event\Dto\EventUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

final class EventUpdateRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'title'            => [
                'required',
                'string',
                'max:255',
            ],
            'description'      => [
                'nullable',
                'string',
            ],
            'event_date'       => [
                'required',
                'date',
            ],
            'location'         => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_public'        => [
                'boolean',
            ],
            'category_id'      => [
                'nullable',
                'exists:event_categories,id',
            ],
            'template_id'      => [
                'nullable',
                'exists:event_templates,id',
            ],
            'terms_conditions' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * @return EventUpdateDto
     */
    public function toDto(): EventUpdateDto
    {
        return new EventUpdateDto(
            id: $this->route('event'),  // Получаем ID события из маршрута
            title: $this->input('title'),
            description: $this->input('description'),
            eventDate: $this->input('event_date'),
            location: $this->input('location'),
            isPublic: $this->boolean('is_public'),
            categoryId: $this->input('category_id'),
            templateId: $this->input('template_id'),
            companyId: $this->input('company_id'),
            termsConditions: $this->input('terms_conditions'),
        );
    }
}