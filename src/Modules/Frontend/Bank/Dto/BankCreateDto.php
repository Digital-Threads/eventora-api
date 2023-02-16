<?php

namespace Modules\Frontend\Bank\Dto;

final class BankCreateDto
{
    public function __construct(
        public int $companyId,
        public string $bankName,
        public ?string $country,
        public ?string $city,
        public ?string $address
    ) {
    }
}
