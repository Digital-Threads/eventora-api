<?php

namespace Domain\Ticket\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Frontend\Dashboard\Ticket\Dto\TicketQueryRequestDto;

interface TicketQueryRepositoryInterface
{
    public function query(TicketQueryRequestDto $dto): Collection;
}
