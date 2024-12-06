<?php

namespace Modules\Frontend\Dashboard\Ticket\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Frontend\Dashboard\Ticket\Dto\TicketQueryRequestDto;
use Modules\Frontend\Dashboard\Ticket\Repositories\Interfaces\TicketQueryRepositoryInterface;

class TicketQueryService
{
    public function __construct(
        protected TicketQueryRepositoryInterface $ticketQueryRepository
    ) {
    }

    public function query(TicketQueryRequestDto $dto): Collection
    {
        return $this->ticketQueryRepository->query($dto);
    }
}
