<?php

namespace Modules\Event\Http\Requests;

use Modules\Event\Dto\EventCreateDto;
use Illuminate\Foundation\Http\FormRequest;

final class EventCreateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'eventDate' => 'required|date',
            'location' => 'nullable|string',
            'isPublic' => 'required|boolean',
            'categoryId' => 'nullable|integer|exists:event_categories,id',
            'templateId' => 'nullable|integer|exists:event_templates,id',
            'companyId' => 'nullable|integer|exists:companies,id',
            'termsConditions' => 'nullable|string',
        ];
    }

    /**
     * @return EventCreateDto
     */
    public function toDto(): EventCreateDto
    {
        return new EventCreateDto(
            $this->input('title'),
            $this->input('description'),
            $this->input('eventDate'),
            $this->input('location'),
            $this->input('isPublic'),
            $this->input('organizerId'),
            $this->input('categoryId'),
            $this->input('templateId'),
            $this->input('companyId'),
            $this->input('termsConditions'),
        );
    }
}