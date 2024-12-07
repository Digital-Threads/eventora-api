<?php

namespace Domain\Ticket\Repositories;

use Modules\Ticket\Dto\TicketCreateRequestDto;

interface TicketCommandRepositoryInterface
{
    public function create(TicketCreateRequestDto $dto);

    public function update(int $id, array $data): void;

    public function delete(int $ticketId): void;
}
