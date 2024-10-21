<?php

namespace Modules\Ticket\Services;

use Infrastructure\Eloquent\Models\Ticket;
use Modules\Ticket\Dto\TicketCreateRequestDto;
use Modules\Ticket\Dto\TicketDeleteRequestDto;
use Modules\Ticket\Dto\TicketUpdateRequestDto;
use Modules\Ticket\Repositories\Interfaces\TicketCommandRepositoryInterface;

final class TicketCommandService
{
    public function __construct(
        protected TicketCommandRepositoryInterface $ticketCommandRepository
    ) {}

    public function create(TicketCreateRequestDto $dto): Ticket
    {
        return $this->ticketCommandRepository->create($dto);
    }

    public function update(TicketUpdateRequestDto $dto): void
    {
        $this->ticketCommandRepository->update($dto->ticketId,
            [
                'type'     => $dto->type,
                'price'    => $dto->price,
                'quantity' => $dto->quantity,
                'discount' => $dto->discount,
            ]);
    }

    public function delete(TicketDeleteRequestDto $dto): void
    {
        $this->ticketCommandRepository->delete($dto->ticketId);
    }
}
