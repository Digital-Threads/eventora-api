<?php

namespace Modules\Frontend\Dashboard\Event\Repositories;

use Infrastructure\Eloquent\Models\Event;
use Modules\Frontend\Dashboard\Event\Dto\EventCreateRequestDto;
use Modules\Frontend\Dashboard\Event\Dto\EventUpdateRequestDto;
use Modules\Frontend\Dashboard\Event\Repositories\Interfaces\EventCommandRepositoryInterface;

class EloquentEventCommandRepository implements EventCommandRepositoryInterface
{
    public function create(EventCreateRequestDto $dto): Event
    {
        return Event::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'event_date' => $dto->eventDate,
            'location' => $dto->location,
            'is_public' => $dto->isPublic,
            'organizer_id' => $dto->organizerId,
            'category_id' => $dto->categoryId,
            'template_id' => $dto->templateId,
            'company_id' => $dto->companyId,
            'terms_conditions' => $dto->termsConditions,
            'image_url' => $dto->imageUrl,
            'max_participants' => $dto->maxParticipants,
            'age_limit' => $dto->ageLimit,
            'event_type' => $dto->eventType,
            'streaming_link' => $dto->streamingLink,
            'tags' => $dto->tags,
            'registration_deadline' => $dto->registrationDeadline,
            'qr_code' => $dto->qrCode,
        ]);
    }

    public function update(EventUpdateRequestDto $dto): Event
    {
        $event = Event::findOrFail($dto->id);
        $event->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'event_date' => $dto->eventDate,
            'location' => $dto->location,
            'is_public' => $dto->isPublic,
            'category_id' => $dto->categoryId,
            'template_id' => $dto->templateId,
            'company_id' => $dto->companyId,
            'terms_conditions' => $dto->termsConditions,
            'image_url' => $dto->imageUrl,
            'max_participants' => $dto->maxParticipants,
            'age_limit' => $dto->ageLimit,
            'event_type' => $dto->eventType,
            'streaming_link' => $dto->streamingLink,
            'tags' => $dto->tags,
            'registration_deadline' => $dto->registrationDeadline,
            'qr_code' => $dto->qrCode,
        ]);

        return $event;
    }

    public function delete(int $eventId): void
    {
        $event = Event::findOrFail($eventId);
        $event->delete();
    }
}
