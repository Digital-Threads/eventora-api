<?php

namespace Modules\Event\Repositories;

use Infrastructure\Eloquent\Models\Event;
use Modules\Event\Repositories\Interfaces\EventCommandRepositoryInterface;
use Modules\Event\Dto\EventCreateDto;
use Modules\Event\Dto\EventUpdateDto;

class EloquentEventCommandRepository implements EventCommandRepositoryInterface
{
    public function create(EventCreateDto $dto): Event
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
        ]);
    }

    public function update(EventUpdateDto $dto): Event
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
        ]);

        return $event;
    }

    public function delete(int $eventId): void
    {
        $event = Event::findOrFail($eventId);
        $event->delete();
    }
}