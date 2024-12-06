<?php

namespace Modules\Frontend\Dashboard\Ticket\Dto;

final class TicketDeleteRequestDto
{
    public function __construct(
        public int $ticketId
    ) {}
}