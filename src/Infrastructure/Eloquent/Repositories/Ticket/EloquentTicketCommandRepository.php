<?php

namespace Infrastructure\Eloquent\Repositories\Ticket;

use Modules\Ticket\Dto\TicketCreateRequestDto;
use Domain\Ticket\Repositories\TicketCommandRepositoryInterface;
use Exception;
use Infrastructure\Eloquent\Models\Ticket;

class EloquentTicketCommandRepository implements TicketCommandRepositoryInterface
{
    public function create(TicketCreateRequestDto $dto): Ticket
    {
        return Ticket::create([
            'event_id' => $dto->eventId,
            'type' => $dto->type,
            'price' => $dto->price,
            'quantity' => $dto->quantity,
            'discount' => $dto->discount,
        ]);
    }

    /**
     * @throws Exception
     */
    public function delete(int $ticketId): void
    {
        Ticket::query()->where('id', $ticketId)->delete();
    }

    public function update(int $id, array $data): void
    {
        Ticket::query()->whereId($id)->update($data);
    }
}
