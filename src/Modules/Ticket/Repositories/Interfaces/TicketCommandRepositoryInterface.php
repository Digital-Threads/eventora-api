<?php

namespace Modules\Ticket\Repositories\Interfaces;

use Infrastructure\Eloquent\Models\Ticket;
use Modules\Ticket\Dto\TicketCreateRequestDto;

interface TicketCommandRepositoryInterface
{
    public function create(TicketCreateRequestDto $dto);

    public function update(int $id, array $data):void ;

    public function delete(int $ticketId): void;

}
