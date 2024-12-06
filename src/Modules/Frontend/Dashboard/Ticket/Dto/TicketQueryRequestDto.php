<?php

namespace Modules\Frontend\Dashboard\Ticket\Dto;

final class TicketQueryRequestDto
{
    public function __construct(
        public int $eventId
    ) {
    }
}
