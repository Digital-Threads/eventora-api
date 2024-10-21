<?php

namespace Modules\Ticket\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Ticket\Dto\TicketQueryRequestDto;
use Modules\Ticket\Repositories\Interfaces\TicketQueryRepositoryInterface;

class TicketQueryService
{
    public function __construct(
        protected TicketQueryRepositoryInterface $ticketQueryRepository
    ) {}

    public function query(TicketQueryRequestDto $dto): Collection
    {
        return $this->ticketQueryRepository->query($dto);
    }
}