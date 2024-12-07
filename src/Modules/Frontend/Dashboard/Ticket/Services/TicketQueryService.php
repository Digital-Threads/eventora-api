<?php

namespace Modules\Frontend\Dashboard\Ticket\Services;

use Domain\Ticket\Repositories\TicketQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Modules\Frontend\Dashboard\Ticket\Dto\TicketQueryRequestDto;

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
