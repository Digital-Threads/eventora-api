<?php

namespace Modules\Frontend\Dashboard\Ticket\Repositories\Interfaces;

use Modules\Frontend\Dashboard\Ticket\Dto\TicketCreateRequestDto;

interface TicketCommandRepositoryInterface
{
    public function create(TicketCreateRequestDto $dto);

    public function update(int $id, array $data):void ;

    public function delete(int $ticketId): void;

}
