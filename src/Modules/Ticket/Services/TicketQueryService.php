<?php

namespace Modules\Ticket\Services;

use Modules\Ticket\Dto\TicketQueryRequestDto;
use Domain\Ticket\Repositories\TicketQueryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
