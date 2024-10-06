<?php

namespace Modules\Event\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\Event\Dto\EventCreateRequestDto;

// Исправленное название DTO

final class EventCreateRequest extends FormRequest
{

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title'                => 'required|string',
            'description'          => 'nullable|string',
            'eventDate'            => 'required|date',
            'location'             => 'nullable|string',
            'isPublic'             => 'required|boolean',
            'categoryId'           => 'nullable|integer|exists:event_categories,id',
            'templateId'           => 'nullable|integer|exists:event_templates,id',
            'companyId'            => 'nullable|integer|exists:companies,id',
            'termsConditions'      => 'nullable|string',
            'imageUrl'             => 'nullable|string',
            'maxParticipants'      => 'nullable|integer',
            'ageLimit'             => 'nullable|integer',
            'eventType'            => 'nullable|string|in:online,offline',
            'streamingLink'        => 'nullable|string',
            'tags'                 => 'nullable|array',
            'registrationDeadline' => 'nullable|date',
            'qrCode'               => 'nullable|string',
        ];
    }

    /**
     * @return EventCreateRequestDto
     */
    public function toDto(): EventCreateRequestDto
    {
        return new EventCreateRequestDto(
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
            $this->input('imageUrl'),
            $this->input('maxParticipants'),
            $this->input('ageLimit'),
            $this->input('eventType'),
            $this->input('streamingLink'),
            $this->input('tags'),
            $this->input('registrationDeadline'),
            $this->input('qrCode')
        );
    }
}
