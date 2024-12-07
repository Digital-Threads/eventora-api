<?php

namespace Infrastructure\Eloquent\Repositories\Event;

use Modules\Event\Dto\EventCreateRequestDto;
use Modules\Event\Dto\EventUpdateRequestDto;
use Domain\Event\Repositories\EventCommandRepositoryInterface;
use Infrastructure\Eloquent\Models\Event;

class EloquentEventCommandRepository implements EventCommandRepositoryInterface
{
    public function create(EventCreateRequestDto $dto): Event
    {
        return Event::query()->create([
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
        $event = Event::query()->findOrFail($dto->id);
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
        $event = Event::query()->findOrFail($eventId);
        $event->delete();
    }
}
