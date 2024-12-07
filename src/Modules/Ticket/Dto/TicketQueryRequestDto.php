<?php

namespace Modules\Ticket\Dto;

final class TicketQueryRequestDto
{
    public function __construct(
        public int $eventId
    ) {
    }
}
