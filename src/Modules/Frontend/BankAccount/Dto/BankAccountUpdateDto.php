<?php

namespace Modules\Frontend\BankAccount\Dto;

final class BankAccountUpdateDto
{
    public function __construct(
        public int $bankId,
        public int $bankAccount,
        public int $currencyId
    ) {
    }
}
