<?php

namespace Modules\Frontend\Dashboard\Ticket\Dto;

final class TicketUpdateRequestDto
{
    public function __construct(
        public int $ticketId,
        public ?string $type = null,
        public ?float $price = null,
        public ?int $quantity = null,
        public ?float $discount = null,
    ) {}
}