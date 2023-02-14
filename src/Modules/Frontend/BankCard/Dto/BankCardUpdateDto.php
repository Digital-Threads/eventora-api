<?php

namespace Modules\Frontend\BankCard\Dto;

final class BankCardUpdateDto
{
    public function __construct(
        public int $bankId,
        public int $cardNumber,
        public ?string $cardEmployeeName,
        public ?int $expiredMonth,
        public ?int $expiredYear,
        public int $currencyId
    ) {
    }
}
