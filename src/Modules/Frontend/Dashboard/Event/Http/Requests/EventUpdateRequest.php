<?php

namespace Modules\Frontend\Dashboard\Event\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Frontend\Dashboard\Event\Dto\EventUpdateRequestDto;

// Исправленное название DTO

final class EventUpdateRequest extends FormRequest
{
    /**
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'is_public' => 'boolean',
            'category_id' => 'nullable|exists:event_categories,id',
            'template_id' => 'nullable|exists:event_templates,id',
            'terms_conditions' => 'nullable|string',
            'image_url' => 'nullable|string',
            'max_participants' => 'nullable|integer',
            'age_limit' => 'nullable|integer',
            'event_type' => 'nullable|string|in:online,offline',
            'streaming_link' => 'nullable|string',
            'tags' => 'nullable|array',
            'registration_deadline' => 'nullable|date',
            'qr_code' => 'nullable|string',
        ];
    }

    /**
     */
    public function toDto(): EventUpdateRequestDto
    {
        return new EventUpdateRequestDto(
            id: $this->route('event'),
            title: $this->input('title'),
            description: $this->input('description'),
            eventDate: $this->input('event_date'),
            location: $this->input('location'),
            isPublic: $this->boolean('is_public'),
            categoryId: $this->input('category_id'),
            templateId: $this->input('template_id'),
            companyId: $this->input('company_id'),
            termsConditions: $this->input('terms_conditions'),
            imageUrl: $this->input('image_url'),
            maxParticipants: $this->input('max_participants'),
            ageLimit: $this->input('age_limit'),
            eventType: $this->input('event_type'),
            streamingLink: $this->input('streaming_link'),
            tags: $this->input('tags'),
            registrationDeadline: $this->input('registration_deadline'),
            qrCode: $this->input('qr_code')
        );
    }
}
