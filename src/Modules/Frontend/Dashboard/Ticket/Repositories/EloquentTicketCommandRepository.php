<?php

namespace Modules\Frontend\Dashboard\Ticket\Repositories;

use Exception;
use Infrastructure\Eloquent\Models\Ticket;
use Modules\Frontend\Dashboard\Ticket\Dto\TicketCreateRequestDto;
use Modules\Frontend\Dashboard\Ticket\Repositories\Interfaces\TicketCommandRepositoryInterface;

class EloquentTicketCommandRepository implements TicketCommandRepositoryInterface
{
    public function create(TicketCreateRequestDto $dto): Ticket
    {
        return Ticket::create([
            'event_id' => $dto->eventId,
            'type'     => $dto->type,
            'price'    => $dto->price,
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
