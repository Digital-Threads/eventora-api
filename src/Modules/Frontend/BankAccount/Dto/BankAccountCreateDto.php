<?php

namespace Modules\Frontend\BankAccount\Dto;

final class BankAccountCreateDto
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
