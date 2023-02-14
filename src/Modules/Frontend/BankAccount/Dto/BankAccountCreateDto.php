<?php

namespace Modules\Frontend\BankAccount\Dto;

final class BankAccountCreateDto
{
    public function __construct(
        public int $bankId,
        public int $bankAccount,
        public int $currencyId
    ) {
    }
}
