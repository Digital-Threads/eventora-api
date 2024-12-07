<?php

namespace Infrastructure\Eloquent\Repositories\Ticket;


use Domain\Ticket\Repositories\TicketQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Eloquent\Models\Ticket;
use Modules\Frontend\Dashboard\Ticket\Dto\TicketQueryRequestDto;

class EloquentTicketQueryRepository implements TicketQueryRepositoryInterface
{

    public function query(TicketQueryRequestDto $dto): Collection
    {
        return Ticket::query()->where('event_id', $dto->eventId)->get();
    }
}
