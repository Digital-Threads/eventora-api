<?php

namespace Domain\Ticket\Repositories;

use Modules\Ticket\Dto\TicketQueryRequestDto;
use Illuminate\Database\Eloquent\Collection;

interface TicketQueryRepositoryInterface
{
    public function query(TicketQueryRequestDto $dto): Collection;
}
