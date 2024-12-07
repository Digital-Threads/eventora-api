<?php

namespace Modules\Ticket\Dto;

final class TicketCreateRequestDto
{
    public function __construct(
        public int $eventId,
        public string $type,
        public float $price,
        public int $quantity,
        public ?float $discount = null,
    ) {
    }
}
