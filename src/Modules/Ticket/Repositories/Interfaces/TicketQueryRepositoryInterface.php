<?php

namespace Modules\Ticket\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Ticket\Dto\TicketQueryRequestDto;

interface TicketQueryRepositoryInterface
{
    public function query(TicketQueryRequestDto $dto): Collection;
}