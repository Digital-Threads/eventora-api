<?php

namespace Modules\Ticket\Dto;

final class TicketDeleteRequestDto
{
    public function __construct(
        public int $ticketId
    ) {
    }
}
